#!/usr/bin/env python3
from __future__ import annotations

import csv
import re
import sys
import textwrap
import time
from pathlib import Path
from urllib.request import urlopen, Request
from urllib.parse import quote

ROOT = Path(__file__).resolve().parents[1]
TARGET_FILE = ROOT / 'data' / 'target_genes.tsv'
HPA_EXPR_FILE = ROOT / 'data' / 'raw' / 'rna_immune_cell.tsv'
UNIPROT_RAW = ROOT / 'data' / 'raw' / 'uniprot_immune_genes.tsv'
GENES_CSV = ROOT / 'data' / 'genes.csv'
EXPR_CSV = ROOT / 'data' / 'expression.csv'
FASTA_OUT = ROOT / 'data' / 'protein_sequences.fasta'

USER_AGENT = 'HTML_Study coursework data preparation (contact: local)'


def fetch_text(url: str) -> str:
    req = Request(url, headers={'User-Agent': USER_AGENT})
    with urlopen(req, timeout=60) as r:
        return r.read().decode('utf-8')


def read_targets() -> list[dict[str, str]]:
    with TARGET_FILE.open(newline='') as f:
        return list(csv.DictReader(f, delimiter='\t'))


def parse_fasta(text: str) -> tuple[str, str]:
    header = ''
    seq_parts = []
    for line in text.splitlines():
        if line.startswith('>'):
            if not header:
                header = line[1:]
        elif line.strip():
            seq_parts.append(line.strip())
    return header, ''.join(seq_parts)


def protein_name_from_fasta_header(header: str) -> str:
    # UniProt header example:
    # sp|P05231|IL6_HUMAN Interleukin-6 OS=Homo sapiens OX=9606 GN=IL6 PE=1 SV=1
    m = re.search(r'^[^ ]+\s+(.+?)\s+OS=', header)
    if m:
        return m.group(1).strip()
    return header.strip()


def download_uniprot(targets: list[dict[str, str]]) -> dict[str, dict[str, str]]:
    annotations: dict[str, dict[str, str]] = {}
    UNIPROT_RAW.parent.mkdir(parents=True, exist_ok=True)

    with UNIPROT_RAW.open('w', newline='') as raw_tsv, FASTA_OUT.open('w') as fasta_out:
        wrote_header = False
        for idx, t in enumerate(targets, start=1):
            acc = t['uniprot_id']
            symbol = t['gene_symbol']

            fasta_url = f'https://rest.uniprot.org/uniprotkb/{acc}.fasta'
            fasta_text = fetch_text(fasta_url)
            header, sequence = parse_fasta(fasta_text)
            protein_name = protein_name_from_fasta_header(header)

            fasta_out.write(f'>gene_{idx}|{symbol}\n')
            for chunk in textwrap.wrap(sequence, 70):
                fasta_out.write(chunk + '\n')

            fields = 'accession,id,gene_primary,protein_name,organism_name,length'
            tsv_url = (
                'https://rest.uniprot.org/uniprotkb/search?'
                f'query=accession:{quote(acc)}&format=tsv&fields={fields}'
            )
            tsv_text = fetch_text(tsv_url)
            lines = [line for line in tsv_text.splitlines() if line.strip()]
            if lines:
                if not wrote_header:
                    raw_tsv.write(lines[0] + '\n')
                    wrote_header = True
                for line in lines[1:]:
                    raw_tsv.write(line + '\n')
                    cols = line.split('\t')
                    if len(cols) >= 6:
                        protein_name = cols[3] or protein_name

            annotations[acc] = {
                'protein_name': protein_name,
                'sequence': sequence,
                'source_url': f'https://www.uniprot.org/uniprotkb/{acc}/entry',
            }
            time.sleep(0.15)

    return annotations


def build_genes_csv(targets: list[dict[str, str]], annotations: dict[str, dict[str, str]]):
    fields = [
        'gene_symbol', 'ensembl_id', 'uniprot_id', 'protein_name', 'species',
        'gene_class', 'description', 'sequence_type', 'sequence',
        'source_database', 'source_url'
    ]
    with GENES_CSV.open('w', newline='') as f:
        w = csv.DictWriter(f, fieldnames=fields)
        w.writeheader()
        for t in targets:
            ann = annotations[t['uniprot_id']]
            w.writerow({
                'gene_symbol': t['gene_symbol'],
                'ensembl_id': t['ensembl_id'],
                'uniprot_id': t['uniprot_id'],
                'protein_name': ann['protein_name'],
                'species': 'Homo sapiens',
                'gene_class': t['gene_class'],
                'description': f"Human immune-related protein annotated in UniProt; class: {t['gene_class']}.",
                'sequence_type': 'protein',
                'sequence': ann['sequence'],
                'source_database': 'UniProt;Human Protein Atlas',
                'source_url': ann['source_url'],
            })


def build_expression_csv(targets: list[dict[str, str]]):
    target_by_ens = {t['ensembl_id']: t for t in targets}
    fields = [
        'gene_symbol', 'ensembl_id', 'sample_name', 'tissue', 'condition_name',
        'expression_value', 'expression_unit', 'source_database'
    ]
    rows = []
    with HPA_EXPR_FILE.open(newline='') as f:
        r = csv.DictReader(f, delimiter='\t')
        for row in r:
            ens = row['Gene']
            if ens not in target_by_ens:
                continue
            t = target_by_ens[ens]
            cell = row['Immune cell']
            rows.append({
                'gene_symbol': t['gene_symbol'],
                'ensembl_id': ens,
                'sample_name': cell,
                'tissue': cell,
                'condition_name': 'normal immune cell',
                'expression_value': row['TPM'],
                'expression_unit': 'TPM',
                'source_database': 'Human Protein Atlas',
            })

    # Stable order: target gene order, then HPA file cell order.
    order = {t['gene_symbol']: i for i, t in enumerate(targets)}
    rows.sort(key=lambda x: (order[x['gene_symbol']], x['sample_name']))

    with EXPR_CSV.open('w', newline='') as f:
        w = csv.DictWriter(f, fieldnames=fields)
        w.writeheader()
        w.writerows(rows)

    return rows


def main():
    if not TARGET_FILE.exists():
        sys.exit(f'Missing {TARGET_FILE}')
    if not HPA_EXPR_FILE.exists():
        sys.exit(f'Missing {HPA_EXPR_FILE}; download and unzip HPA immune-cell data first.')

    targets = read_targets()
    annotations = download_uniprot(targets)
    build_genes_csv(targets, annotations)
    expression_rows = build_expression_csv(targets)

    print(f'Generated {GENES_CSV} ({len(targets)} genes)')
    print(f'Generated {EXPR_CSV} ({len(expression_rows)} expression rows)')
    print(f'Generated {FASTA_OUT} ({len(targets)} FASTA records)')


if __name__ == '__main__':
    main()

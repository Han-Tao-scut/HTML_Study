#!/usr/bin/env python3
from __future__ import annotations

import csv
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
GENES = ROOT / 'data' / 'genes.csv'
EXPR = ROOT / 'data' / 'expression.csv'
SQL = ROOT / 'sql' / 'database_init.sql'


def q(value) -> str:
    if value is None:
        value = ''
    return "'" + str(value).replace("'", "''") + "'"


def main():
    genes = list(csv.DictReader(GENES.open()))
    expr = list(csv.DictReader(EXPR.open()))

    sample_names = []
    seen = set()
    for row in expr:
        if row['sample_name'] not in seen:
            seen.add(row['sample_name'])
            sample_names.append(row['sample_name'])

    gene_id = {g['gene_symbol']: i + 1 for i, g in enumerate(genes)}
    sample_id = {s: i + 1 for i, s in enumerate(sample_names)}
    sample_meta = {}
    for row in expr:
        sample_meta.setdefault(row['sample_name'], row)

    lines = [
        '-- Human immune-related gene expression database seeded from HPA and UniProt',
        '-- Data sources: Human Protein Atlas rna_immune_cell.tsv and UniProtKB REST/FASTA records',
        'CREATE DATABASE IF NOT EXISTS bio_demo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;',
        'USE bio_demo;',
        '',
        'DROP VIEW IF EXISTS view_source_summary;',
        'DROP VIEW IF EXISTS view_gene_class_summary;',
        'DROP VIEW IF EXISTS view_species_summary;',
        'DROP VIEW IF EXISTS view_dataset_counts;',
        'DROP TABLE IF EXISTS expression;',
        'DROP TABLE IF EXISTS import_logs;',
        'DROP TABLE IF EXISTS samples;',
        'DROP TABLE IF EXISTS genes;',
        '',
        '''CREATE TABLE genes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gene_symbol VARCHAR(100) NOT NULL UNIQUE,
    ensembl_id VARCHAR(100) UNIQUE,
    uniprot_id VARCHAR(100),
    protein_name TEXT,
    species VARCHAR(255) NOT NULL,
    gene_class VARCHAR(255),
    description TEXT,
    sequence_type VARCHAR(50) DEFAULT 'protein',
    sequence MEDIUMTEXT,
    source_database VARCHAR(255),
    source_url TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);''',
        '',
        '''CREATE TABLE samples (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sample_name VARCHAR(255) NOT NULL UNIQUE,
    tissue VARCHAR(255),
    condition_name VARCHAR(255),
    species VARCHAR(255) NOT NULL,
    source_database VARCHAR(255),
    description TEXT
);''',
        '',
        '''CREATE TABLE expression (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gene_id INT NOT NULL,
    sample_id INT NOT NULL,
    expression_value DOUBLE NOT NULL,
    expression_unit VARCHAR(50) DEFAULT 'TPM',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uniq_gene_sample (gene_id, sample_id),
    CONSTRAINT fk_expression_gene FOREIGN KEY (gene_id) REFERENCES genes(id) ON DELETE CASCADE,
    CONSTRAINT fk_expression_sample FOREIGN KEY (sample_id) REFERENCES samples(id) ON DELETE CASCADE
);''',
        '',
        '''CREATE TABLE import_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    import_type VARCHAR(100) NOT NULL,
    records_inserted INT NOT NULL DEFAULT 0,
    imported_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notes TEXT
);''',
        '',
        'INSERT INTO genes (gene_symbol, ensembl_id, uniprot_id, protein_name, species, gene_class, description, sequence_type, sequence, source_database, source_url) VALUES'
    ]

    for i, g in enumerate(genes):
        suffix = ',' if i < len(genes) - 1 else ';'
        values = [g[k] for k in ['gene_symbol','ensembl_id','uniprot_id','protein_name','species','gene_class','description','sequence_type','sequence','source_database','source_url']]
        lines.append('(' + ', '.join(q(v) for v in values) + ')' + suffix)

    lines += ['', 'INSERT INTO samples (sample_name, tissue, condition_name, species, source_database, description) VALUES']
    for i, sample in enumerate(sample_names):
        row = sample_meta[sample]
        suffix = ',' if i < len(sample_names) - 1 else ';'
        lines.append('(' + ', '.join([
            q(sample),
            q(row.get('tissue', sample)),
            q(row.get('condition_name', 'normal immune cell')),
            q('Homo sapiens'),
            q('Human Protein Atlas'),
            q('HPA immune cell RNA expression summary sample')
        ]) + ')' + suffix)

    lines += ['', 'INSERT INTO expression (gene_id, sample_id, expression_value, expression_unit) VALUES']
    for i, row in enumerate(expr):
        suffix = ',' if i < len(expr) - 1 else ';'
        lines.append(f"({gene_id[row['gene_symbol']]}, {sample_id[row['sample_name']]}, {row['expression_value']}, {q(row['expression_unit'])}){suffix}")

    lines += [
        '',
        'INSERT INTO import_logs (file_name, import_type, records_inserted, notes) VALUES',
        f"('genes.csv', 'seed_genes', {len(genes)}, 'Real gene metadata and protein sequences from UniProt; target IDs mapped in target_genes.tsv'),",
        f"('expression.csv', 'seed_expression', {len(expr)}, 'Human Protein Atlas immune-cell RNA expression TPM records');",
        '',
        '''CREATE VIEW view_dataset_counts AS
SELECT 'genes' AS table_name, COUNT(*) AS record_count FROM genes
UNION ALL
SELECT 'samples' AS table_name, COUNT(*) AS record_count FROM samples
UNION ALL
SELECT 'expression' AS table_name, COUNT(*) AS record_count FROM expression;''',
        '',
        '''CREATE VIEW view_species_summary AS
SELECT species, COUNT(*) AS gene_count
FROM genes
GROUP BY species
ORDER BY species;''',
        '',
        '''CREATE VIEW view_gene_class_summary AS
SELECT gene_class, COUNT(*) AS gene_count
FROM genes
GROUP BY gene_class
ORDER BY gene_count DESC, gene_class;''',
        '',
        '''CREATE VIEW view_source_summary AS
SELECT source_database, COUNT(*) AS gene_count
FROM genes
GROUP BY source_database
ORDER BY gene_count DESC, source_database;''',
        ''
    ]

    SQL.write_text('\n'.join(lines))
    print(f'Wrote {SQL}')
    print(f'genes={len(genes)} samples={len(sample_names)} expression={len(expr)}')


if __name__ == '__main__':
    main()

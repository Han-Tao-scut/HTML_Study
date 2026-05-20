# Human immune-related gene expression demo database

This directory contains the seed files for the independent course database module. The module is intentionally separate from the metagenomics article pages: it exists to demonstrate relational queries, CRUD operations, BLAST, and dynamic expression plotting on a compact dataset.

## Files

- `target_genes.tsv` — 20 selected human immune-related genes with Ensembl and UniProt identifiers
- `genes.csv` — gene metadata plus protein sequences for database import
- `expression.csv` — 200 demo RNA-seq-style TPM records across 10 normal tissue/sample labels
- `protein_sequences.fasta` — FASTA records for local BLAST database construction

## Scope

- Species: `Homo sapiens`
- Genes: `20`
- Samples: `10`
- Expression records: `200`
- Expression unit: `TPM`

## Source note

Gene identifiers and protein annotations are aligned to Ensembl and UniProt naming conventions. The expression matrix is a compact **demo/simulated** matrix prepared for coursework functionality testing rather than a biological discovery dataset.

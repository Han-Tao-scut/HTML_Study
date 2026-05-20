#!/usr/bin/env bash
set -euo pipefail

PROJECT_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
FASTA="$PROJECT_ROOT/data/protein_sequences.fasta"
OUT_PREFIX="$PROJECT_ROOT/blastdb/gene_protein_db"

MICROMAMBA="/home/hantao/.local/bin/micromamba"
BLAST_ENV="blast"

"$MICROMAMBA" run -n "$BLAST_ENV" makeblastdb \
  -in "$FASTA" \
  -dbtype prot \
  -parse_seqids \
  -out "$OUT_PREFIX"

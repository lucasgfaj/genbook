#!/bin/bash
set -e

# Cria o banco de teste se não existir
psql -h db -U "$DB_USERNAME" -tc "SELECT 1 FROM pg_database WHERE datname = 'genbook_test'" | grep -q 1 || \
psql -h db -U "$DB_USERNAME" -c "CREATE DATABASE genbook_test"

echo "✅ Banco genbook_test garantido!"

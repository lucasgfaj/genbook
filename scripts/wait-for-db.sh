#!/bin/bash
set -e

# Espera o Postgres responder
until pg_isready -h db -U "$DB_USERNAME" > /dev/null 2>&1; do
  echo "⏳ Aguardando o banco ficar pronto..."
  sleep 2
done

# Cria o banco de teste se não existir
psql -h db -U "$DB_USERNAME" -tc "SELECT 1 FROM pg_database WHERE datname = 'genbook_test'" | grep -q 1 || \
psql -h db -U "$DB_USERNAME" -c "CREATE DATABASE genbook_test"

echo "✅ Banco genbook_test garantido!"

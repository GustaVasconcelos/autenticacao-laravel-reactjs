#!/bin/sh

# Verifica se o arquivo .env já existe
if [ ! -f .env ]; then
  echo "Arquivo .env não encontrado. Criando a partir de .env.example..."
  cp .env.example .env
fi

# Instala as dependências do Composer
composer install

# Aguarda o banco de dados estar pronto
sleep 3

# Gera a chave da aplicação (somente se ainda não estiver definida)
php artisan key:generate --force

# Executa as migrações
php artisan migrate --force

# Inicia o servidor Laravel
php artisan serve --host=0.0.0.0 --port=80

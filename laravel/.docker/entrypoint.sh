#!/bin/sh

# Verifica se o arquivo .env j� existe
if [ ! -f .env ]; then
  echo "Arquivo .env n�o encontrado. Criando a partir de .env.example..."
  cp .env.example .env
fi

# Instala as depend�ncias do Composer
composer install

# Aguarda o banco de dados estar pronto
sleep 3

# Gera a chave da aplica��o (somente se ainda n�o estiver definida)
php artisan key:generate --force

# Executa as migra��es
php artisan migrate --force

# Inicia o servidor Laravel
php artisan serve --host=0.0.0.0 --port=80

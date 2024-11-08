# Usa a imagem PHP 8.2 FPM como base
FROM php:8.2-fpm

# Define o diret�rio de trabalho
WORKDIR /var/www/html

# Instala depend�ncias do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    mariadb-client \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala extens�es do PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Copia o Composer para o container
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia os arquivos do aplicativo, exceto o .env (ver .dockerignore)
COPY . /var/www/html

# Se .env ainda n�o existir no container, cria-o a partir de .env.example
RUN if [ ! -f /var/www/html/.env ]; then cp /var/www/html/.env.example /var/www/html/.env; fi

# Define as permiss�es corretas para o diret�rio de trabalho e subdiret�rios
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Instala as depend�ncias do Composer
RUN composer install --optimize-autoloader --no-dev

# Cria as pastas necess�rias e define permiss�es
RUN mkdir -p storage/framework/{sessions,views,cache} storage/app/public storage/logs \
    && chown -R www-data:www-data storage \
    && chown -R www-data:www-data bootstrap/cache

# Exp�e a porta 80
EXPOSE 80

# Comando final para iniciar o servidor Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
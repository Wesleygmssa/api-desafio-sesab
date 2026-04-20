FROM php:8.2-fpm

# Dependências
RUN apt-get update && apt-get install -y \
  git curl zip unzip libpng-dev libonig-dev libxml2-dev

# Extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
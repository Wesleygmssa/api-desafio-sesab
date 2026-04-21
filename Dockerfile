FROM php:8.3-fpm

WORKDIR /var/www

# dependências do sistema
RUN apt-get update && apt-get install -y \
  git curl zip unzip libpng-dev libonig-dev libxml2-dev sqlite3 libsqlite3-dev

# extensões PHP
RUN docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# copia projeto
COPY . .

# permissões
RUN chmod -R 777 storage bootstrap/cache

# entrypoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
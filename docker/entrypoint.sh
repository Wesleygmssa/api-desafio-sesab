#!/bin/bash

echo "🚀 Iniciando container Laravel..."

# garante permissão do SQLite
touch database/database.sqlite
chmod 777 database/database.sqlite

echo "🧹 Limpando cache..."
php artisan config:clear
php artisan cache:clear

echo "🗑️ Resetando banco..."
php artisan migrate:fresh --seed --force

echo "🔥 Subindo servidor..."
exec php artisan serve --host=0.0.0.0 --port=8000
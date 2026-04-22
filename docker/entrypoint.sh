#!/bin/sh

composer install --no-interaction --prefer-dist

echo "🗄️ Preparando banco SQLite..."
touch database/database.sqlite
chmod 777 database/database.sqlite

echo "🧹 Limpando cache..."
php artisan config:clear
php artisan cache:clear

echo "🗑️ Resetando banco..."
php artisan migrate:fresh --seed --force

echo "🔥 Subindo servidor..."

# sobe servidor em background
php artisan serve --host=0.0.0.0 --port=8000 &

# espera ele subir
sleep 3

# chamada de aquecimento (warm up)
curl http://127.0.0.1:8000/api/health || true

# mantém processo vivo
wait
#!/bin/bash

echo "🚀 Iniciando container Laravel..."

# 1. instalar dependências (ESSENCIAL)
echo "📦 Instalando dependências..."
composer install --no-interaction --prefer-dist

# 2. garantir sqlite
echo "🗄️ Preparando banco SQLite..."
touch database/database.sqlite
chmod 777 database/database.sqlite

# 3. limpar cache (agora funciona)
echo "🧹 Limpando cache..."
php artisan config:clear
php artisan cache:clear

# 4. reset banco
echo "🗑️ Resetando banco..."
php artisan migrate:fresh --seed --force

# 5. subir servidor
echo "🔥 Subindo servidor..."
exec php artisan serve --host=0.0.0.0 --port=8000
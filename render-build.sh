#!/usr/bin/env bash
# exit on error
set -o errexit

# Instala dependências PHP para produção
composer install --no-dev --optimize-autoloader

# Limpa caches antigos
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Compila os assets
npm install
npm run build

# Gera chave da aplicação se não existir
php artisan key:generate --force

# Reconstrói os caches de config, rotas e views
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Executa as migrations
php artisan migrate --force

# Garante as permissões corretas
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
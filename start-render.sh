#!/usr/bin/env bash

# Garante que o diretório storage tem as permissões corretas
chown -R www-data:www-data /var/www/storage
chmod -R 775 /var/www/storage

# Limpa os caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Recria os caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Executa as migrações
php artisan migrate --force

# Inicia o servidor Laravel
php artisan serve --host=0.0.0.0 --port=${PORT:-80} 
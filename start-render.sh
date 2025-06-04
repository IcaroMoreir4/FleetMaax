#!/usr/bin/env bash

# Copia a configuração do Nginx
cp /var/www/render.nginx.conf /etc/nginx/sites-enabled/default

# Remove a configuração padrão se existir
rm -f /etc/nginx/sites-enabled/default.conf

# Inicia o PHP-FPM
service php8.2-fpm start

# Garante que o diretório storage tem as permissões corretas
chown -R www-data:www-data /var/www/storage
chmod -R 775 /var/www/storage

# Limpa e recria os caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Executa as migrações
php artisan migrate --force

# Inicia o Nginx em primeiro plano
nginx -g "daemon off;" 
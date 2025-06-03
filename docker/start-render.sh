#!/bin/bash

# Iniciar PHP-FPM em background
php-fpm -D

# Verificar se as variáveis de ambiente estão definidas
if [ ! -f ".env" ]; then
    cp .env.example .env
fi

# Gerar chave se necessário
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Executar migrações
php artisan migrate --force

# Iniciar Nginx em foreground
nginx -g "daemon off;" 
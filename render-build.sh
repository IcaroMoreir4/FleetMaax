#!/usr/bin/env bash
# exit on error
set -o errexit

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Clear and cache routes and config
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Install Node.js dependencies and build assets
npm install
npm run build

# Generate application key if not set
php artisan key:generate --force

# Run database migrations
php artisan migrate --force 
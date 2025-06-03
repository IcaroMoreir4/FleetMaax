FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    curl \
    nginx \
    nodejs \
    npm \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql bcmath opcache

# Instalar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar o diretório de trabalho
WORKDIR /var/www

# Copiar arquivos do projeto
COPY . .

# Copiar configurações
COPY docker/nginx/default.conf /etc/nginx/sites-available/default
COPY docker/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Instalar dependências e otimizar
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && chmod -R 777 storage bootstrap/cache

# Instalar e construir assets
RUN npm install && npm run build

# Script de inicialização
COPY docker/start-render.sh /usr/local/bin/start-render.sh
RUN chmod +x /usr/local/bin/start-render.sh

EXPOSE 8080

CMD ["/usr/local/bin/start-render.sh"] 
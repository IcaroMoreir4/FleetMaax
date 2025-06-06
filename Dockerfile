FROM php:8.2-cli

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    curl \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql bcmath opcache pdo_pgsql

# Instala Node.js e npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www

# Copia os arquivos do projeto
COPY . .

# Remove arquivos e diretórios existentes
RUN rm -rf node_modules package-lock.json public/build

# Instala as dependências do PHP e Node.js, e compila os assets
RUN composer install --prefer-dist --no-interaction --no-progress \
    && npm install --no-audit --no-fund --legacy-peer-deps \
    && npm run build \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && chmod -R 775 storage bootstrap/cache public/build \
    && chown -R www-data:www-data /var/www

# Configura o opcache
COPY ./docker/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Expõe a porta que será usada pelo artisan serve
EXPOSE ${PORT:-80}

# Define o script de inicialização
COPY start-render.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/start-render.sh

CMD ["/usr/local/bin/start-render.sh"] 
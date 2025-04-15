# Usa a imagem oficial do PHP 8.2 com Apache
FROM php:8.2-apache

# Instala dependências do PHP e do Laravel
RUN apt-get update && apt-get install -y \
  libpng-dev \
  libjpeg-dev \
  libfreetype6-dev \
  zip \
  unzip \
  git \
  curl \
  libzip-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install gd pdo pdo_mysql zip

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto para o container
COPY . .

# Dá permissão para a pasta de cache e storage do Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Instala dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Expõe a porta padrão do Apache
EXPOSE 80

# Inicia o Apache quando o container subir
CMD ["apache2-foreground"]

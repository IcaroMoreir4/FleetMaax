FROM php:8.2-apache

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
  zip unzip curl git libzip-dev libpng-dev libonig-dev libxml2-dev \
  && docker-php-ext-install pdo_mysql zip

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilita reescrita no Apache
RUN a2enmod rewrite

# Copia os arquivos do Laravel para o container
COPY . /var/www/html

# Define o diretório como root
WORKDIR /var/www/html

# Ajusta permissões
RUN chown -R www-data:www-data /var/www/html \
  && chmod -R 755 /var/www/html

# Instala as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Define o Apache como servidor padrão
CMD ["apache2-foreground"]

FROM php:8.2-apache

# Instalar dependências
RUN apt-get update && apt-get install -y \
    zip unzip curl libpng-dev libonig-dev libxml2-dev git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Habilitar mod_rewrite do Apache
RUN a2enmod rewrite

# Instalar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar os arquivos do projeto
COPY . /var/www/html

# Definir permissões
RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html

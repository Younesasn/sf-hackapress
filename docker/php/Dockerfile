FROM php:8.3-apache

# Install extensions
RUN apt-get update && apt-get install -y \
    git zip unzip curl libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libpq-dev libicu-dev g++ libxslt-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl gd

# Enable Apache Rewrite
RUN a2enmod rewrite

# Copy Symfony config
COPY . /var/www/html/
WORKDIR /var/www/html

# Permissions
RUN chown -R www-data:www-data /var/www/html

# Use Apache as default web server
EXPOSE 80

FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git zip unzip curl libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libpq-dev libicu-dev g++ libxslt-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl gd

COPY . /var/www/html/
WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

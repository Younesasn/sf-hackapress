FROM php:8.3-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    curl \
    g++ \
    git \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libonig-dev \
    libpng-dev \
    libpq-dev \
    libxml2-dev \
    libxslt-dev \
    libzip-dev \
    unzip \
    zip

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql zip intl gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --no-dev
RUN composer dump-env prod
RUN php bin/console assets:install
RUN php bin/console lexik:jwt:generate-keypair
RUN php bin/console d:d:c
RUN php bin/console d:m:m

# Garde les bons droits pour Symfony
RUN chown -R www-data:www-data /var/www/html

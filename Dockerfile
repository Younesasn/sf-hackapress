FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl git unzip libonig-dev libzip-dev zip libicu-dev \
    && docker-php-ext-install pdo pdo_mysql intl opcache zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Install Caddy
RUN curl -fsSL https://getcaddy.com | bash -s personal

WORKDIR /app
COPY . .

# Permissions
RUN mkdir -p var/cache var/log && chmod -R 777 var

# Config PHP and Caddy
COPY php.ini /usr/local/etc/php/php.ini
COPY Caddyfile /etc/caddy/Caddyfile

# Install dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

EXPOSE 80
CMD ["caddy", "run", "--config", "/etc/caddy/Caddyfile"]

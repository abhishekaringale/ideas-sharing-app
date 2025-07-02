FROM php:8.2-apache

# Set Composer to allow root execution
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Enable Apache Rewrite Module
RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy .env file
RUN cp .env.example .env

# Install PHP dependencies (safely)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Set folder permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

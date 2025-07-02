FROM php:8.2-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Enable mod_rewrite for Laravel
RUN a2enmod rewrite

# Set working directory to Laravel root
WORKDIR /var/www/html

# Copy source code
COPY . /var/www/html

# Move Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy example env file
RUN cp .env.example .env

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# ✅ Apache should serve from /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# ✅ Rewrite Apache config to match Laravel public folder
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

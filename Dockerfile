FROM php:8.3-fpm

# Cài extension cần cho Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype \
    && docker-php-ext-install pdo_mysql gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy only composer files and install dependencies first
COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist

# Copy the rest of the application source
COPY . .

# Quyền cho storage & bootstrap
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 8585

# Chạy server phát triển của Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8585"]
# Base Image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    curl \
    unzip \
    zip \
    git \
    nodejs \
    npm \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd mbstring zip pdo_mysql exif

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files into container
COPY . .

# Cài đặt PHP dependencies (composer)
RUN composer install --no-dev --optimize-autoloader

# Cài đặt Node dependencies (npm)
RUN npm install && npm run build

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]

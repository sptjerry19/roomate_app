# Base Image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    net-tools\
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
    supervisor \
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

# Copy Supervisor configuration
COPY docker/supervisord.conf /etc/supervisord.conf

# Expose ports
EXPOSE 9000 6001

# Start Supervisor
CMD ["supervisord", "-c", "/etc/supervisord.conf"]

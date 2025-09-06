FROM php:7.4-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy custom Apache configuration
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf

# Copy application files
COPY . /var/www/html/

# Set appropriate permissions for CodeIgniter cache and logs
RUN chown -R www-data:www-data /var/www/html/application/cache \
    /var/www/html/application/logs \
    /var/www/html/assets/file \
    /var/www/html/assets/upload \
    /var/www/html/upload \
    && chmod -R 775 /var/www/html/application/cache \
    /var/www/html/application/logs \
    /var/www/html/assets/file \
    /var/www/html/assets/upload \
    /var/www/html/upload

# Expose port 80
EXPOSE 80

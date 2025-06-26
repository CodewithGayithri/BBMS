# Use official PHP image with Apache
FROM php:8.1-apache

# Install required PHP extensions (optional: mysqli for MySQL support)
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache mod_rewrite (optional, for .htaccess or routing)
RUN a2enmod rewrite

# Copy source code into the Apache document root
COPY . /var/www/html/

# Set permissions (optional)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 for Apache
EXPOSE 80

# Apache will automatically run as CMD from the base image

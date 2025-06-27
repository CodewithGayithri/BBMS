# Use official PHP image with Apache
FROM php:8.1-apache

# Install required PHP extensions for MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache mod_rewrite (optional, for .htaccess or routing)
RUN a2enmod rewrite

# Change Apache to listen on port 800 instead of 80
RUN sed -i 's/80/800/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Suppress "ServerName" warning during Apache startup
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy your source code into the Apache document root
COPY . /var/www/html/

# Set permissions for Apache user (optional)
RUN chown -R www-data:www-data /var/www/html

# Expose port 800 for Apache
EXPOSE 800

# The base image automatically runs Apache in the foreground as the CMD

# Use the official PHP image with Apache
FROM php:8.0-apache

# Install necessary PostgreSQL extensions for PHP
RUN docker-php-ext-install pgsql pdo_pgsql

# Install Composer (PHP dependency manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache mod_rewrite (if needed for your app)
RUN a2enmod rewrite

# Copy application files to the Apache document root
COPY . /var/www/html/

# Set correct permissions for Apache to access the app files
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Install Composer dependencies (if a composer.json exists)
WORKDIR /var/www/html
RUN composer install --no-interaction --prefer-dist

# Expose port 80 to access the application
EXPOSE 80
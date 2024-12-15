# Use PHP with Apache as the base image
FROM php:8.2-apache as web

# Install System Dependencies for Composer, PHPUnit, and PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    curl \
    git \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite for URL rewriting
RUN a2enmod rewrite

# Install PHP extensions for PostgreSQL and Composer dependencies
RUN docker-php-ext-install pdo pdo_pgsql

# Configure Apache DocumentRoot to point to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy the application code to the container
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Set permissions for the application
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Expose the port Apache is listening on
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]

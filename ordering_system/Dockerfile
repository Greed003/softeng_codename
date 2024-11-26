# Use PHP with Apache as the base image
FROM php:8.2-apache


# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    curl \
    libpq-dev && \  
    apt-get clean && rm -rf /var/lib/apt/lists/*


# Enable Apache mod_rewrite for URL rewriting
RUN a2enmod rewrite


# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql pgsql zip  # Install PDO and pgsql extensions for PostgreSQL


# Configure Apache DocumentRoot
ENV APACHE_DOCUMENT_ROOT=/var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


# Install Composer (PHP dependency manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Set the working directory to the application code location
WORKDIR /var/www/html


# Copy composer files first to install dependencies early (this avoids re-installing dependencies on every code change)
COPY composer.json composer.lock ./


# Install PHP dependencies (without dev dependencies)
RUN composer install --no-dev --optimize-autoloader


# Copy the application code to the container
COPY . .


# Set permissions for the application (recommended for Docker images running with Apache)
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html


# Expose the port Apache is listening on
EXPOSE 80


# Start Apache in the foreground
CMD ["apache2-foreground"]

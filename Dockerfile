# Use an Ubuntu base image
FROM php:8.4-rc-apache


# Update package manager and install required dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd\
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Enable Apache modules
RUN a2enmod rewrite

# Copy application code to /var/www/html/
COPY ./ /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Set proper permissions for the web directory
RUN chown -R www-data:www-data /var/www/html

# Expose the default HTTP port
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]

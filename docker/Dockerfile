FROM php:8.1-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y
# Set working directory
WORKDIR /var/www/html
# Enable mod_rewrite for Laravel
RUN a2enmod rewrite
# Copy Apache virtual host configuration
COPY apache-vhost.conf /etc/apache2/sites-available/000-default.conf
# Expose port 80
EXPOSE 80
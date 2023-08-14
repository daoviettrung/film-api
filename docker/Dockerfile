FROM php:8.1-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install zip
# Get latest Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --version=2.1.6 --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"
# Set working directory
WORKDIR /var/www/html/
# Enable mod_rewrite for Laravel
RUN a2enmod rewrite
RUN a2enmod headers
# Copy Apache virtual host configuration
COPY apache-vhost.conf /etc/apache2/sites-available/000-default.conf
# Expose port 80
EXPOSE 80
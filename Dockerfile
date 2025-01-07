FROM php:8.2-apache
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql zip gd

RUN a2enmod rewrite
WORKDIR /var/www/html
# Copy only composer files first (to leverage Docker layer caching)
COPY ./Backend-dev/composer.json ./Backend-dev/composer.lock /var/www/html/
# Install Composer and dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader
# Copy the entire application after installing dependencies
COPY ./Backend-dev /var/www/html
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
EXPOSE 80
# Start Apache
CMD ["apache2-foreground"]



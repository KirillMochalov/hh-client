FROM php:7.3-apache
WORKDIR /var/www/html/
EXPOSE 80

# Xdebug installation
RUN pecl install xdebug && docker-php-ext-enable xdebug

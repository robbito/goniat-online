FROM php:8.0-apache
RUN docker-php-ext-install mysqli && a2enmod rewrite
COPY src/ /var/www/html/

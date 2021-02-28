FROM php:8.0-apache
RUN docker-php-ext-install mysqli && a2enmod rewrite
COPY src/ /var/www/html/
RUN chown -R www-data:www-data /var/www/html/fig &&\
    chmod -R g+w /var/www/html/fig
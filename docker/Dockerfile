FROM php:8.5-apache
RUN docker-php-ext-install mysqli && a2enmod rewrite && echo "ServerName localhost" > /etc/apache2/conf-available/servername.conf && a2enconf servername
COPY src/ /var/www/html/
RUN chown -R www-data:www-data /var/www/html/fig &&\
    chmod -R g+w /var/www/html/fig
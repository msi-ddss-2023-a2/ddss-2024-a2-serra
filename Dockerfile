FROM php:8.1.31-apache

RUN a2enmod rewrite

RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html

COPY ./src /var/www/html/

EXPOSE 80

CMD ["apache2-foreground"]
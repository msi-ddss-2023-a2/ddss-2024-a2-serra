FROM php:8.1.31-apache

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY ./src /var/www/html/

EXPOSE 80

CMD ["apache2-foreground"]
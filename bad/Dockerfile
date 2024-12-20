FROM php:8.1.31-apache

#RUN mkdir -p /var/www/html/ddss

#RUN mkdir -p /var/www/html/ddss/public

#RUN mkdir -p /var/www/html/ddss/src

WORKDIR /var/www/html/ddss-bad/public

COPY ./bad/public /var/www/html/ddss-bad/public

COPY ./bad/src /var/www/html/ddss-bad/src

# Get Php Extension For PGsql
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Apache Stuff
RUN chown -R www-data:www-data /var/www/html/ddss-bad \
    && chmod -R 755 /var/www/html/ddss-bad

COPY ./bad/ddss.conf /etc/apache2/sites-available/ddss-bad.conf

RUN a2ensite ddss-bad.conf

RUN a2dissite 000-default.conf

# RUN service apache2 reload

RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]
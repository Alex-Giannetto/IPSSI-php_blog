FROM php:7.2-apache

RUN docker-php-ext-install pdo_mysql && \ 
 sed -ri -e 's!/var/www/html!/app!g' /etc/apache2/sites-available/000-default.conf && \
 sed -ri -e 's!/var/www/!/app!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/docker-php.conf

RUN a2enmod rewrite


WORKDIR /app
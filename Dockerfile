FROM php:7.4-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli
COPY . /var/www/html
COPY php.ini /usr/local/etc/php
EXPOSE 80

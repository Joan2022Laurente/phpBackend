FROM php:8.2-apache

# Instala pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html/
EXPOSE 80

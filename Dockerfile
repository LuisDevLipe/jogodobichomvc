# syntax=docker/dockerfile:1
FROM php:8.2-apache

RUN apt update && apt install -y
RUN docker-php-ext-install pdo pdo_mysql

RUN chmod 755 /var/www
WORKDIR /var/www/html
COPY . .

RUN cat vhost.conf > /etc/apache2/sites-available/vhost.conf
RUN a2ensite vhost.conf
RUN a2enmod rewrite
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN service apache2 restart

# FROM composer
# WORKDIR /var/www/html
# RUN composer install

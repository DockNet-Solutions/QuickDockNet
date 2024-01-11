FROM php:8.0-apache
RUN docker-php-ext-install pdo pdo_mysql opcache 

RUN service apache2 restart
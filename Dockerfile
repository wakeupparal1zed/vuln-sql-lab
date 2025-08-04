FROM php:8.3-fpm

RUN docker-php-ext-install pdo_pgsql pgsql

WORKDIR /app
COPY . /app

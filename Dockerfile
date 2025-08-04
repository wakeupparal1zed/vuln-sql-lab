FROM php:8.3-fpm
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo_pgsql pgsql
WORKDIR /app
COPY . /app

FROM php:8.2-cli


RUN apt-get update && apt-get install -y libpq-dev

RUN docker-php-ext-install pdo_mysql pdo_pgsql

WORKDIR /app
COPY . /app

RUN echo "allow_url_fopen=On" > /usr/local/etc/php/conf.d/zz-allow-url.ini

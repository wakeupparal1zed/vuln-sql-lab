FROM php:8.2-cli

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /app

COPY . /app

RUN echo "allow_url_fopen=On" > /usr/local/etc/php/conf.d/zz-allow_url.ini #ssrf

EXPOSE 8080

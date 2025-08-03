FROM php:8.2-cli
RUN docker-php-ext-install pdo_pgsql pgsql pdo pdo_mysql
WORKDIR /app
COPY . /app
RUN echo "allow_url_fopen=On" > /usr/local/etc/php/conf.d/zz-allow-url.ini

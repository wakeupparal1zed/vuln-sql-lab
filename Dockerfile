FROM php:8.3-apache

# PHP + Postgres
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql

# Apache будет искать index.php в /var/www/html/public
RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && printf '\n<Directory "/var/www/html/public">\n  AllowOverride All\n  Require all granted\n</Directory>\n' >> /etc/apache2/apache2.conf

# Копируем код
COPY . /var/www/html

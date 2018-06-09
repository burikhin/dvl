FROM php:7.2.2-fpm

RUN apt-get update && apt-get install -y mysql-client --no-install-recommends \
    && docker-php-ext-install pdo_mysql

COPY . /var/www

RUN chown -R www-data:www-data /var/www
RUN chmod 755 /var/www
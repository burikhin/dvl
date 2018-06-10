FROM bitnami/php-fpm:latest

COPY composer.lock composer.json /var/www/

COPY database /var/www/database

WORKDIR /var/www

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && php composer.phar install --no-dev --no-scripts \
    && rm composer.phar

COPY . /var/www

RUN chown -R www-data:www-data \
        /var/www/storage \
        /var/www/bootstrap/cache \
    && chmod -Rf 0777 /var/www/storage \
    && mv /var/www/.env.prod /var/www/.env \

FROM php:7.4-fpm

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer

WORKDIR /app

COPY . /app

RUN composer install --no-interaction -o

FROM php:7.0-fpm

RUN apt-get update && apt-get install -y git zip libssl-dev zlib1g-dev && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    pecl install mongodb && docker-php-ext-enable mongodb && \
    docker-php-ext-install zip

COPY php.ini /usr/local/etc/php/

RUN usermod -u 1000 www-data

VOLUME /var/www/ibe-hotel-api

WORKDIR /var/www/ibe-hotel-api

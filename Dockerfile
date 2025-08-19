FROM php:8.3-fpm-alpine AS php-container
LABEL author='Dagweb'

###> Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
###< Install composer

###> Configure dev env
RUN apk add --no-cache git
RUN apk add --no-cache --virtual .build-deps autoconf dpkg-dev dpkg file g++ gcc libc-dev make pkgconf re2c linux-headers
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug
RUN apk del --no-network .build-deps;
###< Configure dev env

COPY . /opt/public-holiday
WORKDIR /opt/public-holiday

RUN composer install

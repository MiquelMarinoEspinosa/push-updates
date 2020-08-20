FROM php:7-cli-alpine

RUN apk add --no-cache --update --virtual buildDeps autoconf && apk add --no-cache alpine-sdk && apk add --no-cache yaml-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN pecl install redis && docker-php-ext-enable redis
RUN mkdir -p /app
RUN composer global require hirak/prestissimo

WORKDIR /app
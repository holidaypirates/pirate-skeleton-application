FROM php:7.3-fpm-alpine
RUN apk add --no-cache $PHPIZE_DEPS && pecl install xdebug-2.7.1
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR "/code"

FROM php:8-fpm-alpine
RUN apk update && apk upgrade
RUN apk add curl
RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
        && pecl install redis \
        && docker-php-ext-enable redis.so

WORKDIR /project

RUN rm -rf /project
RUN ln -s project

RUN docker-php-ext-enable opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

ENTRYPOINT ["php-fpm"]
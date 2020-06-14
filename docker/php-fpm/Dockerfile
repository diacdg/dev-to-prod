ARG VERSION
ARG COMPOSER_NO_DEV

FROM php:${VERSION:-7.4}-fpm as www

WORKDIR /var/www

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git && \
    apt-get install -y zip unzip zlib1g-dev libicu-dev g++ librabbitmq-dev libssh-dev && \
    pecl install amqp

RUN docker-php-ext-install mysqli && \
    docker-php-ext-install pdo_mysql &&\
    docker-php-ext-install sockets &&\
    docker-php-ext-configure intl &&\
    docker-php-ext-install intl &&\
    docker-php-ext-install bcmath &&\
    docker-php-ext-enable amqp

# COPY ./docker/php-fpm/prod/www.conf /usr/local/etc/php-fpm.d/www.conf

COPY . .

RUN chown -R www-data:www-data .

RUN su - www-data -s /bin/bash -c 'php composer.phar install --optimize-autoloader --no-interaction ${COMPOSER_NO_DEV:+"--no-dev"}'


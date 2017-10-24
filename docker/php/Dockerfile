FROM php:7.1-fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libmcrypt-dev \
        libmemcached-dev \
        zlib1g-dev \
        libicu-dev \
        g++ \
        git \
        ssh

RUN docker-php-ext-install -j$(nproc) \
        iconv \
        mcrypt \
        pdo \
        pdo_mysql \
        mbstring \
        bcmath

RUN pecl install apcu memcached \
    && docker-php-ext-enable apcu memcached

RUN curl -sS https://getcomposer.org/installer \
      | php -- --install-dir=/usr/local/bin --filename=composer

RUN git clone -q https://github.com/NoiseByNorthwest/php-spx.git ~/php-spx \
    && cd ~/php-spx \
    && phpize \
    && ./configure \
    && make \
    && make install

WORKDIR /var/www
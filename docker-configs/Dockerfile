FROM php:8.3-fpm

ARG UID
ARG GID

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    nodejs \
    npm

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN groupadd -g $GID laravel
RUN useradd -u $UID -g laravel -m laravel

WORKDIR /var/www/html

RUN chown -R laravel:laravel /var/www/html

USER laravel
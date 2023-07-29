FROM php:8.1 as php

RUN apt-get update -y && apt-get install -y \
  libicu-dev \
  libmariadb-dev \
  unzip zip \
  zlib1g-dev \
  libpng-dev \
  libjpeg-dev \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  curl
RUN docker-php-ext-install pdo pdo_mysql bcmath

WORKDIR /var/www
COPY . .

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Define the commands to run when the container starts
CMD php artisan migrate && \
  php artisan db:seed && \
  php artisan key:generate && \
  php artisan cache:clear && \
  php artisan config:clear && \
  php artisan route:clear && \
  php artisan serve --host=0.0.0.0 --port=$(php -r "echo env('PORT', '8080');") --env=.en

# ==============================================================================
#  node
FROM node:14-alpine as node

WORKDIR /var/www
COPY . .

RUN npm install --global cross-env
RUN npm install

# VOLUME /var/www/node_modules
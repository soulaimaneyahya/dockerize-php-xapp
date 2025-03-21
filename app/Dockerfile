FROM php:8.3-fpm

WORKDIR /var/www/html

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.json .

RUN composer install

COPY . .

EXPOSE 9000

FROM php:8.3-fpm

WORKDIR /var/www/html

# Install required system dependencies for PHP extensions and utilities
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    default-mysql-client \
    iputils-ping \
    libmariadb-dev \
    libmariadb-dev-compat \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions: pdo, pdo_mysql (for MySQL support)
RUN docker-php-ext-install pdo pdo_mysql

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN chmod +x /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# Generate composer completion and move it to correct location
RUN composer completion bash > /root/composer-completion.bash && \
    cp /root/composer-completion.bash /etc/bash_completion.d/composer

# Ensure completion is sourced
RUN echo "source /etc/bash_completion.d/composer" >> /etc/bash.bashrc

# Install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

COPY . .

EXPOSE ${SERVER_PORT}

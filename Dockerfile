# Dockerfile
FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libssl-dev \
    librabbitmq-dev  # librabbitmq kütüphanesi için

RUN apt-get install -y libpq-dev  # PostgreSQL sürücüsünü yüklemek için
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql  # PostgreSQL uzantısını eklemek için

RUN pecl install amqp \
    && docker-php-ext-enable amqp

RUN pecl install redis \
    && docker-php-ext-enable redis

WORKDIR /var/www/html

COPY . .

EXPOSE 9000

CMD ["php-fpm"]

FROM php:7.3-apache


RUN a2enmod rewrite


RUN apt-get update && apt-get install -y \
    zip unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd


COPY . /var/www/html


ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


COPY --from=composer:2.7.9  /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
RUN composer install

EXPOSE 80

FROM php:7.1-fpm

# Install modules
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
    && docker-php-ext-install iconv mcrypt \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql

COPY ./ /var/www/

CMD ["/usr/local/sbin/php-fpm"]
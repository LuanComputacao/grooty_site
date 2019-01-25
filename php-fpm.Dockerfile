FROM php:7-fpm-alpine
RUN /bin/sh -c "docker-php-ext-install pdo_mysql"
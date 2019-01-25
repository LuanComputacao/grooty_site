FROM php:7-fpm-alpine

COPY php-fpm-bootstrap.sh /root/bootstrap.sh

RUN sh /root/bootstrap.sh

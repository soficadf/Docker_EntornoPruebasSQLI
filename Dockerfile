FROM php:8.0.0-apache
ARG DEBIAN_FRONTEND=noninteractive
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-enable  pdo_mysql
RUN apt-get update \
    && rm -rf /var/lib/apt/lists/* 

RUN a2enmod rewrite
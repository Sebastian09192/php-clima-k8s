FROM php:8.2-apache

RUN apt-get update && apt-get install -y ca-certificates curl && update-ca-certificates

COPY index.php /var/www/html/index.php

EXPOSE 80

FROM php:7.2-apache-buster
COPY . /var/www/html
WORKDIR /var/www/html

RUN apt update 
RUN apt install -y php-mysql

EXPOSE 80

FROM php:8.2.1-fpm
LABEL author="Nicolas Luckie <nicolasluckie@gmail.com>"

# Install and enable mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
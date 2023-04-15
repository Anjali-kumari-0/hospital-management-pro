# FROM php
# COPY ./index.php ./
# EXPOSE 80
# CMD  ["php","-s","0.0.0.0.80"]


# command on terminial
# docker build . -t imagr/php 
# docker run --name=php-server -p=3030:80 image/php
# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . .

# Install any dependencies required by your application
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libpq-dev \
    && docker-php-ext-install \
    gd \
    mysqli \
    pdo_mysql \
    pdo_pgsql \
    && a2enmod rewrite

# Expose port 80 for incoming web traffic
EXPOSE 80

# Start the Apache web server when the container starts
CMD ["apache2-foreground"]


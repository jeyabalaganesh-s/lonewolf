FROM php:8.1-apache

# Copy your PHP files into the Apache server directory
COPY . /var/www/html/

# Open port 80 (Render default)
EXPOSE 80

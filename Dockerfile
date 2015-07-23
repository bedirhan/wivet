FROM php:5.6-apache

# Copy wivet's source code
COPY . /var/www/html/

# Make sure we can write to the stats directory
RUN chmod 777 /var/www/html/offscanpages/statistics/

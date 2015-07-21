FROM php:5.6-apache

# Install modules
RUN apt-get update \
    && apt-get install -y php5-mysql \
    && docker-php-ext-install mysqli

# Copy wivet's source code
COPY . /var/www/html/

# Uncomment if you want to use wivet's file backend
#RUN chmod 777 /var/www/html/offscanpages/statistics/

# You may uncomment these lines to enable the mysql data store
RUN sed -i 's/file/db/g;' /var/www/html/config.sample.php
RUN sed -i 's/localhost/wivet/g;' /var/www/html/config.sample.php

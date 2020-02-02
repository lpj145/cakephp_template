FROM php:7.3-apache

RUN apt-get update \
&& apt-get install -y libpq-dev libicu-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql pdo_mysql
RUN apt-get remove -y libicu-dev libpq-dev
RUN a2enmod rewrite
RUN php -r "copy('http://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
COPY ./config/000-default.conf /etc/apache2/sites-available/000-default.conf
EXPOSE 80
WORKDIR /var/www
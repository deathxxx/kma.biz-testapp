FROM php:8.2-fpm

RUN apt-get update \
    && apt-get -y --no-install-recommends install php8.2-mysqli php8.2-gd php8.2-xsl php8.2-yaml php8.2-intl \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
RUN docker-php-ext-install mysqli
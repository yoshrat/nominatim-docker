FROM php:5.6-apache
MAINTAINER winsent <pipetc@gmail.com>

RUN apt-get -y update --fix-missing && \
    apt-get install -y \
    build-essential \
    cmake \
    libgeos-dev \
    libpq-dev \
    libbz2-dev \
    libtool \
    libproj-dev \
    libboost-dev  \
    libboost-system-dev \
    libboost-filesystem-dev \
    libboost-thread-dev \
    libexpat-dev \
    libgeos-c1 libgeos++-dev libxml2-dev \
    git \
    liblua5.1-dev \
    postgresql-server-dev-all \
    postgresql-client && \
    docker-php-ext-install pgsql && \
    rm -rf /var/lib/apt/lists/* && \
    rm -rf /tmp/* /var/tmp/*

WORKDIR /app

# Nominatim install
RUN git clone --recursive git://github.com/twain47/Nominatim.git ./src && \
    cmake ./src && make

# Apache & PHP configuration
COPY config/php.ini /usr/local/etc/php/
COPY config/nominatim.conf /etc/apache2/sites-enabled/default.conf

# Nominatim create site
COPY config/local.php ./settings/local.php
RUN pear install DB && php ./utils/setup.php --create-website /var/www/html

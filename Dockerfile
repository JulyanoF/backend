FROM php:8.1-apache-buster

RUN apt update 

RUN apt-get install -y \
    wget \
    nano \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    libcurl4-openssl-dev

RUN docker-php-ext-install \
    pdo_pgsql \
    mbstring \
    pcntl \
    bcmath \
    gd \
    curl \
    intl

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY --chown=www-data:www-data . /var/www/html

RUN chmod +x /var/www/html/docker-entrypoint.sh

CMD [ "/var/www/html/docker-entrypoint.sh" ]

EXPOSE 80
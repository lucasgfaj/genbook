FROM php:8.3.4-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    tzdata \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo_pgsql zip

# Configura timezone para America/Sao_Paulo
RUN ln -fs /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime && dpkg-reconfigure -f noninteractive tzdata

# Ajusta o php.ini para usar esse timezone
RUN echo "date.timezone=America/Sao_Paulo" > /usr/local/etc/php/conf.d/timezone.ini
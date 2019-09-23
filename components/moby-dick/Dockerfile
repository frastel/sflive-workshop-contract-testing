FROM debian:10

ENV DEBIAN_FRONTEND noninteractive

RUN echo 'Europe/Berlin' > /etc/timezone && dpkg-reconfigure tzdata
RUN echo 'APT::Install-Recommends "0";' > /etc/apt/apt.conf.d/01recommends

# upgrade system
RUN apt-get update \
    && apt-get upgrade -yq \
    && apt-get install -yq \
    apt-transport-https \
    ca-certificates \
    software-properties-common \
    curl \
    git \
    unzip \
    php7.3-cli \
    php7.3-fpm \
    php7.3-intl \
    php7.3-mysql  \
    php7.3-sqlite3\
    php7.3-curl \
    php7.3-gd \
    php7.3-xml \
    php7.3-mbstring \
    php7.3-zip \
    php7.3-xdebug \
    nginx-full \
    supervisor \
    default-mysql-client \
    --no-install-recommends && \
    apt-get clean && apt-get purge && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN sed -i "s@doc_root =@doc_root =/code/public@" /etc/php/7.3/fpm/php.ini && \
    sed -i "s@;error_log = php_errors.log@error_log = /proc/self/fd/2@" /etc/php/7.3/fpm/php.ini && \
    echo "date.timezone = Europe/Paris" >> /etc/php/7.3/cli/php.ini && \
    echo "date.timezone = Europe/Paris" >> /etc/php/7.3/fpm/php.ini && \
    echo "daemon off;" >> /etc/nginx/nginx.conf && \
    mkdir /run/php && chown www-data:www-data /run/php

RUN phpdismod -v 7.3 -s ALL opcache && phpenmod -v 7.3 -s ALL xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --preview

ADD src/ /

WORKDIR /code

EXPOSE 80 443

CMD /usr/bin/supervisord


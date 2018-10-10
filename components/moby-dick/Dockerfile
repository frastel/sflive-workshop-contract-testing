FROM ubuntu:18.10

ENV DEBIAN_FRONTEND noninteractive

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
    php7.2-cli \
    php7.2-fpm \
    php7.2-intl \
    php7.2-mysql  \
    php7.2-sqlite3\
    php7.2-curl \
    php7.2-gd \
    php7.2-xml \
    php7.2-mbstring \
    php7.2-zip \
    nginx-full \
    supervisor \
    mysql-client \
    --no-install-recommends && \
    apt-get clean && apt-get purge && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN sed -i "s@doc_root =@doc_root =/code/public@" /etc/php/7.2/fpm/php.ini && \
    sed -i "s@;error_log = php_errors.log@error_log = /proc/self/fd/2@" /etc/php/7.2/fpm/php.ini && \
    echo "date.timezone = Europe/Paris" >> /etc/php/7.2/cli/php.ini && \
    echo "date.timezone = Europe/Paris" >> /etc/php/7.2/fpm/php.ini && \
    echo "daemon off;" >> /etc/nginx/nginx.conf && \
    mkdir /run/php && chown www-data:www-data /run/php

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --preview

ADD src/ /

WORKDIR /code

EXPOSE 80 443

CMD /usr/bin/supervisord


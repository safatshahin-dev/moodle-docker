#base image
FROM ubuntu:20.04

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -y \
    git \
    curl \
    locales \
    apache2 \
    php \
    php-cli \
    php-curl \
    php-fpm \
    php-gd \
    php-intl \
    php-ldap \
    php-mbstring \
    php-mysql \
    php-soap \
    php-xdebug \
    php-xml \
    php-xmlrpc \
    php-zip \
    htop \
    nano \
    vim \
    && rm -rf /var/lib/apt/lists/*

RUN locale-gen en_AU.UTF-8
RUN cd /usr/local/lib/ && curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

#apache servername to resolve host
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
# RUN echo "127.0.0.1 localunixsocket.local" >> /etc/hosts
#crontab
RUN apt-get update && apt-get -y install cron
COPY cron /etc/cron.d/cron
RUN chmod 0644 /etc/cron.d/cron
RUN crontab /etc/cron.d/cron
RUN touch /var/log/cron.log
RUN cron
#moodledata to connect from volume
RUN mkdir /var/www/moodledata
# RUN mkdir /var/www/moodledata && chown www-data /var/www/moodledata
# RUN mkdir /var/www/moodledata/filedir && chown www-data /var/www/moodledata/filedir
#custom php.ini
COPY php.ini /etc/php/7.4/apache2/php.ini
#filedir to moodledata inside container, for better caching, if you want to use shared moodledata, comment this line
# ADD /data/filedir/* /var/www/moodledata/filedir/
# RUN chmod -R 777 /var/www/moodledata
#entrypoint commands after server start
COPY entrypoint.sh /
RUN chmod +x /entrypoint.sh
#working directory
WORKDIR /data/moodle/

ENTRYPOINT ["/entrypoint.sh"]
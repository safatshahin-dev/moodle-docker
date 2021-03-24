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
    openssl \
    && rm -rf /var/lib/apt/lists/*

RUN locale-gen en_AU.UTF-8
RUN cd /usr/local/lib/ && curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

#apache servername to resolve host
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
# RUN echo "127.0.0.1 localunixsocket.local" >> /etc/hosts
#ssl
RUN rm -rf /var/www/html/*; rm -rf /etc/apache2/sites-enabled/*; \
    mkdir -p /etc/apache2/external

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2

RUN sed -i 's/^ServerSignature/#ServerSignature/g' /etc/apache2/conf-enabled/security.conf; \
    sed -i 's/^ServerTokens/#ServerTokens/g' /etc/apache2/conf-enabled/security.conf; \
    echo "ServerSignature Off" >> /etc/apache2/conf-enabled/security.conf; \
    echo "ServerTokens Prod" >> /etc/apache2/conf-enabled/security.conf; \
    a2enmod ssl; \
    a2enmod headers; \
    echo "SSLProtocol ALL -SSLv2 -SSLv3" >> /etc/apache2/apache2.conf

ADD 000-default.conf /etc/apache2/sites-enabled/000-default.conf
ADD 001-default-ssl.conf /etc/apache2/sites-enabled/001-default-ssl.conf
#uncomment if you are using your own key
#COPY cert.pem /etc/apache2/external/cert.pem
#COPY key.pem /etc/apache2/external/key.pem
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
EXPOSE 80 
EXPOSE 443
#entrypoint commands after server start
COPY entrypoint.sh /
RUN chmod a+x /entrypoint.sh
#working directory
WORKDIR /data/moodle/

ENTRYPOINT ["/entrypoint.sh"]

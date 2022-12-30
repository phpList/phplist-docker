
FROM debian:buster-slim

LABEL maintainer="michiel@phplist.com" 

RUN apt-get update && apt-get upgrade -y

RUN apt-get install -y apt-utils \
    vim apache2 net-tools php-mysql \
    libapache2-mod-php php-curl php-gd \
    git cron php-imap php-xml php-zip php-mbstring

RUN rm -f /etc/apache2/sites-enabled/000-default.conf && \
    cd /var/www/ && find . -type d -name .git -print0 | xargs -0 rm -rf && \
    find . -type d -print0 | xargs -0 chmod 755 && \
    find . -type f -print0 | xargs -0 chmod 644

COPY docker-apache-phplist.conf /etc/apache2/sites-enabled/
COPY phplist-crontab /etc/cron.d
COPY docker-entrypoint.sh /usr/local/bin/

RUN useradd -d /var/www/phpList3 phplist

ARG REFRESH=unknown
ARG VERSION=unknown
RUN echo REFRESH=${REFRESH}
RUN echo VERSION=${VERSION}

RUN rm -rf /var/www/phpList3 && mkdir /var/www/phpList3
RUN rm -rf /etc/phpList3 && mkdir /etc/phpList3

COPY phplist-${VERSION}/ /var/www/phpList3
COPY docker/docker-phplist-config-live.php /etc/phplist/config.php

RUN mkdir -p /var/www/phpList3/public_html/images && \
    mkdir -p /var/www/phpList3/public_html/lists/admin/plugins && \
    chmod 777 /var/www/phpList3/public_html/images && \
    chmod 777 /var/www/phpList3/public_html/lists/admin/plugins

RUN chown -R www-data: /var/www/phpList3

EXPOSE 80 

ENTRYPOINT ["docker-entrypoint.sh"]

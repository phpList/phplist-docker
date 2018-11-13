
FROM debian:stretch-slim

MAINTAINER Michiel Dethmers <michiel@phplist.com>
RUN apt-get update && apt-get upgrade -y

RUN apt-get install -y apt-utils \
    vim apache2 net-tools php-mysql \
    libapache2-mod-php php-curl php-gd \
    git cron php-imap php-xml php-zip

ADD phpList3/ /var/www/phpList3

RUN rm -f /etc/apache2/sites-enabled/000-default.conf && \
    cd /var/www/ && find . -type d -name .git -print0 | xargs -0 rm -rf && \
    find . -type d -print0 | xargs -0 chmod 755 && \
    find . -type f -print0 | xargs -0 chmod 644 && \
    mkdir /var/www/phpList3/public_html/images && \
    chmod 777 /var/www/phpList3/public_html/images && \
    chmod 777 /var/www/phpList3/public_html/lists/admin/plugins

COPY docker-apache-phplist.conf /etc/apache2/sites-enabled/
COPY docker-phplist-config-live.php /var/www/phpList3/config.php
COPY phplist-crontab /
RUN crontab /phplist-crontab
COPY docker-entrypoint.sh /usr/local/bin/

EXPOSE 80 443

VOLUME ["/var/www", "/var/log/apache2"]
ENTRYPOINT ["docker-entrypoint.sh"]

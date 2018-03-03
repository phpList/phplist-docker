
FROM debian:jessie-slim

MAINTAINER Michiel Dethmers <michiel@phplist.com>
RUN apt-get update && apt-get upgrade -y

RUN apt-get install -y apt-utils \
    vim apache2 net-tools php5-mysql \
    libapache2-mod-php5 php5-curl php5-gd \
    git cron php5-imap

RUN cd /var/www/ && \
    git clone https://github.com/phplist/phplist3.git phpList3 && \
    cd phpList3/public_html/lists && \
    rm -f texts && git clone https://github.com/phpList/phplist-lan-texts.git texts && \
    cd admin/ && rm -f help && git clone https://github.com/phpList/phplist-lan-help.git help && \
    rm -f info && git clone https://github.com/phpList/phplist-lan-info.git info && \
    cd ui && \
    git clone https://github.com/phplist/phplist-ui-dressprow.git dressprow && \
    git clone https://github.com/phpList/phplist-ui-bootlist.git

RUN cd /tmp && git clone https://github.com/bramley/phplist-plugin-ckeditor.git && \
    mv phplist-plugin-ckeditor/plugins/* /var/www/phpList3/public_html/lists/admin/plugins/ && \
    rm -rf phplist-plugin-ckeditor

RUN rm -f /etc/apache2/sites-enabled/000-default.conf && \
    cd /var/www/ && find . -type d -name .git -print0 | xargs -0 rm -rf && \
    find . -type d -print0 | xargs -0 chmod 755 && \
    find . -type f -print0 | xargs -0 chmod 644 && \
    mkdir /var/www/phpList3/public_html/images && \
    chmod 777 /var/www/phpList3/public_html/images && \
    chmod 777 /var/www/phpList3/public_html/lists/admin/plugins

ARG REFRESH=unknown
RUN echo REFRESH=${REFRESH}

COPY docker-apache-phplist.conf /etc/apache2/sites-enabled/
COPY docker-phplist-config.php /var/www/phpList3/config.php
COPY phplist-crontab /
RUN crontab /phplist-crontab
COPY docker-entrypoint.sh /usr/local/bin/

#RUN chmod 755 /usr/bin/phplist
#RUN /usr/bin/phplist -pinitialise

EXPOSE 80 443

VOLUME ["/var/www", "/var/log/apache2", "/etc/apache2"]
#CMD ["/bin/bash"]
#CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
ENTRYPOINT ["docker-entrypoint.sh"]

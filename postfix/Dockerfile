FROM ubuntu:trusty
#FROM debian:jessie-slim

RUN apt-get update && \
     apt-get install -q -y language-pack-en vim rsyslog

# Set noninteractive mode for apt-get
ENV DEBIAN_FRONTEND noninteractive

EXPOSE 25/tcp 465/tcp 587/tcp

VOLUME /var/log/postfix
VOLUME /var/spool/postfix

RUN apt-get update -q -q && \
 echo postfix postfix/main_mailer_type string "'Internet Site'" | debconf-set-selections && \
 echo postfix postfix/mynetworks string "127.0.0.0/8, 172.0.0.0/8" | debconf-set-selections && \
 echo postfix postfix/mailname string mailhost | debconf-set-selections && \
 apt-get --yes --force-yes install postfix

RUN postconf -e myhostname=mailhost
RUN postconf -e mydestination="mailhost, test-mailhost.phplist.com, localhost.localdomain, localhost"
RUN postconf -e mail_spool_directory="/var/spool/mail/"
RUN postconf -e mailbox_command=""

# Add a local user to receive mail at phplist@test-mailhost.phplist.com, with a delivery directory
# (for the Maildir format).
RUN useradd -s /bin/bash phplist
RUN mkdir /var/spool/mail/phplist
RUN chown phplist:mail /var/spool/mail/phplist
COPY postfix-crontab /
COPY clean-mail.sh /
RUN crontab /postfix-crontab && start cron

CMD ["sh", "-c", "service rsyslog start ; service postfix start ; tail -F /var/log/mail.log"]
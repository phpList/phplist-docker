
#Choose Debian
FROM debian:latest
#MAINTAINER DiouxX "github@diouxx.be"
#https://hub.docker.com/r/diouxx/apache-proxy/
#Don't ask questions during install
ENV DEBIAN_FRONTEND noninteractive

#Install apache2 and enable proxy mode

RUN apt update \
&& apt -y install \
apache2 \
nano
RUN a2enmod proxy \
&& a2enmod proxy_http \
&& service apache2 stop
#Ports
EXPOSE 80 443
#Volumes
#VOLUME /opt/proxy-conf
#Launch Apache2 on FOREGROUND

COPY proxy.conf /opt/proxy-conf/

COPY apache-proxy-start.sh /opt/
RUN chmod +x /opt/apache-proxy-start.sh
ENTRYPOINT ["/opt/apache-proxy-start.sh"]
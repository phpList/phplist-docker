FROM mariadb:10.1

## create a new mysql data location
RUN mkdir /var/mysql
RUN sed -i s~/var/lib/mysql~/var/mysql~ /etc/mysql/my.cnf

#COPY large-dataset.sql.gz /data.sql.gz
COPY medium-dataset.sql.gz /data.sql.gz

COPY phplist-entrypoint.sh /docker-entrypoint-initdb.d

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["mysqld"]

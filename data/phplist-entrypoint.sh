#!/bin/bash

echo Creating phpList DB

mysqladmin -uroot -p${MYSQL_ROOT_PASSWORD} create phplistdb
mysql -uroot -p${MYSQL_ROOT_PASSWORD} -e "grant all on phplistdb.* to phplist@'%' identified by 'phplist'"

gunzip -c /data.sql.gz | mysql -uphplist -pphplist phplistdb
#rm -f /data.sql.gz



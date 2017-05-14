#!/bin/bash

## this script will find the postfix container and
## show the output of the mail log file

PFC=$(docker ps -q -f 'ancestor=phplist/postfix')

[ "$PFC" ] && \
docker exec $(docker ps -q -f 'ancestor=phplist/postfix') tail -f /var/log/mail.log

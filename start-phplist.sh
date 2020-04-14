#!/bin/bash

FILE=phplist.yml
cd $(dirname $0)
test=$1

## check if any of the DEV settings are found
. .env
if [ -z $test ] && [ -n "$THEME_DEV_PATH" ] && [ -n "$CODE_PATH" ] && [ -n "$CODE_PATH" ]; then
    FILE=phplist-dev.yml
    echo Using the DEV version
fi

docker stop $(docker ps -q)
docker-compose -f $FILE down --remove-orphans 
docker-compose -f $FILE pull
docker-compose -f $FILE up -d -V


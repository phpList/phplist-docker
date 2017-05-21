#!/bin/bash

FILE=phplist.yml
cd $(dirname $0)

. .env
if [ -n "$THEME_DEV_PATH" ] || [ -n "$CODE_PATH" ] || [ -n "$CODE_PATH" ]; then
    FILE=phplist-dev.yml
    echo Using the DEV version
fi

docker-compose -f $FILE down

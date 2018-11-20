#!/bin/bash

cd $(dirname $0)

FILE=${1:-phplist.yml}

# Sourcing the configuration file.
# NOTE One can override default compose file here
. .env

if [[ -n $THEME_DEV_PATH ]] && [[ -n $CODE_PATH ]] && [[ -n $PLUGIN_DEV_PATH ]]; then
    FILE=phplist-dev.yml
    echo Using the DEV version
fi

docker-compose -f $FILE down

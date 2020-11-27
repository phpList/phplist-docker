#!/bin/bash

VERSION=$1

cd "$(dirname "$0")"
. .env

if [[ -f $VERSIONDIR/phplist-${VERSION}.tgz ]]; then
    docker rmi -f phplist/phplist:$VERSION
    docker system prune -f
    tar zxf ~/Nextcloud/phpList-versions/phplist-${VERSION}.tgz 
    docker build --build-arg VERSION=$VERSION --no-cache -f Dockerfile -t phplist/phplist:$VERSION .
    docker push phplist/phplist:$VERSION
    rm -rf phplist-${VERSION}
else
    docker rmi -f phplist/phplist:latest
    docker build --no-cache -f Dockerfile.git -t phplist/phplist:latest .
    docker push phplist/phplist:latest
fi

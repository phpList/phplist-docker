#!/bin/bash

VERSION=$1

if [ -d phplist-$VERSION ]; then
	docker rmi -f phplist/phplist:$VERSION
#	docker system prune -f
	docker build --build-arg REFRESH=$(date +%s) --build-arg VERSION=$VERSION -f Dockerfile -t phplist/phplist:$VERSION .
	docker push phplist/phplist:$VERSION
else
	docker rmi -f phplist/phplist:latest
	docker build --build-arg REFRESH=$(date +%s) -f Dockerfile.git -t phplist/phplist:latest .
	docker push phplist/phplist:latest
fi

#!/bin/bash

pwd=$(pwd)
cd phplist
docker build -f Dockerfile -t phplist/phplist:latest .
#docker push phplist/phplist:latest

cd $pwd/postfix

docker build -f Dockerfile -t phplist/postfix:latest .

cd $pwd/data

docker build -f Dockerfile -t phplist/testdata:base .

cd $pwd/proxy

docker build -f Dockerfile -t proxy:latest .

docker images

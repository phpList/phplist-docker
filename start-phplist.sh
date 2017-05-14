#!/bin/bash

docker-compose -f phplist.yml down
docker-compose -f phplist.yml pull
docker-compose -f phplist.yml up -d


#!/bin/bash

docker-compose -f phplist.yml down
docker-compose -f phplist.yml build
docker-compose -f phplist.yml up -d


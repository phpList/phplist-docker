#!/bin/bash

cid=$(docker ps |grep testdata | cut -d ' ' -f 1)
docker exec -it $cid mysqladmin -uphplist -pphplist drop -f phplistdb
docker exec -it $cid mysqladmin -uphplist -pphplist create phplistdb



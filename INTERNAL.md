
##Internal notes

The "internal" branch on Gitlab is for phpList only, and not to be published without
Michiel's permission on Github.



To build the images run the build.sh script

To start the containers run

docker-compose -f phplist-test.yml up -d

To stop the containers run

docker-compose -f phplist-test.yml down

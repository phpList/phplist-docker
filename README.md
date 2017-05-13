# phplist-docker

Run phpList (www.phplist.org) in a Docker environment
The Yaml file will use mariadb

Work in progress, more features coming
The current configuration will not send any emails to the world. All
emails will be delivered to the mailhost machine locally.

## pre-requisites

To use this you need to have a working docker version 2 environment. 
That is unfortunately not just yet too straightforward. 
Head over to https://www.docker.com and get started

You need the following commands (I'm reporting the versions I have, May 2017)
    
    docker
    
        $ docker --version
        Docker version 1.12.6, build 78d1802    

    docker-compose 
    
        $ docker-compose --version
        docker-compose version 1.8.0

## configuration 

Copy the .env-dist file and save it as .env in your current folder

    cp .env-dist .env
   
Edit the values to match your situation

You can leave the database values, but you will need to set
    
    PHPLIST_ADMINNAME=Your Name
    PHPLIST_ADMINPASSWORD=SomeRandomPassword
    PHPLIST_ADMINEMAIL=YourEmail@Yourdomain.com
    
and
    
    PORT=8000
    HOSTNAME=localhost
    
*HOSTNAME* is the name you will be accessing your phpList installation on. Port will be
the port to connect to. To try it out on your local machine, you can use the defaults.

## installation

Once you have set the values in .env, you can run

    ./start-phplist.sh
    
Wait some time, because the first time the database will be created and configured.

Once it's all set up, you will be able to login to phpList on the HOSTNAME and PORT 
you specified in the .env file using "admin" as the login and the PHPLIST_ADMINPASSWORD
you set in the .env file as the password.

In the above example, that means you point your browser at

http://localhost:8000/lists/admin/

and login with username "admin" and password "SomeRandomPassword"


## features

Current features in the container are:

- CKEditor Plugin
- Image Upload works (and will be saved when you stop the container)
- Sending of emails does *not* work



## hints

For docker-compose, visit https://github.com/docker/compose/releases
For docker, visit https://github.com/docker/docker/releases
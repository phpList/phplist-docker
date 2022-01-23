# phplist-docker

Run [phpList](www.phplist.org) in a Docker environment

Work in progress, more features coming. The current configuration will not send any emails to the world. All emails will be delivered to the mailhog container locally.

The main aim of this setup is to facilitate phpList development. If you are looking for 
phpList in Docker, without the need to make any changes, you can find it on [Docker Hub](https://hub.docker.com/repository/docker/phplist/phplist_)

## pre-requisites

To use this you need to have a working docker environment. 
Head over to https://www.docker.com to get started

You need the following commands (I'm reporting the versions I have, Jan 2022)
    
    docker
    
        $ docker --version
Docker version 20.10.12, build e91ed57

    docker-compose 
    
        $ docker-compose --version
docker-compose version 1.29.0, build unknown

## configuration 

Copy the .env-dist file and save it as .env in your current folder

    cp .env-dist .env
   
Edit the values to match your situation

You can leave the database values, but you will need to set
    
    PHPLIST_ADMINNAME="Your Name"
    PHPLIST_ADMINPASSWORD="SomeRandomPassword"
    PHPLIST_ADMINEMAIL=YourEmail@Yourdomain.com
    
and
    
    PORT=8000
    HOSTNAME=localhost
    
*HOSTNAME* is the name you will be accessing your phpList installation on. Port will be
the port to connect to. To try it out on your local machine, you can use the defaults.

## installation

Once you have set the values in .env, you can run

    ./start-phplist.sh

This will choose between two possible scenarios. 
- phpList running from the code in the containers (phplist.yml)
- phpList running from the code on your local machine (phplist-dev.yml)

For the latter, you need to map the code on your machine to the code in the container. You can do this with variables in the .env file.
    
Wait some time, because the first time the database will be created and configured.

Once it's all set up, you will be able to login to phpList on the HOSTNAME and PORT 
you specified in the .env file using "admin" as the login and the PHPLIST_ADMINPASSWORD
you set in the .env file as the password.

In the above example, that means you point your browser at

http://localhost:8000/lists/admin/

and login with username "admin" and password "SomeRandomPassword"


## images and plugins

You can map the images and plugins folders to a folder on the host machine with

    IMAGES=/path/to/images
    PLUGINS=/path/to/plugins

When you do that, they will be retained when you rebuild the system. Make sure the folders are fully world-writable (hint: chmod 777)

When these variables are absent, the images and plugins will be placed on Docker Volumes. 

## features

Current features in the container are:

- CKEditor Plugin
- Image Upload works (and will be saved when you stop the container)
- All emails will be sent to Mailhog, which you can get to with http://localhost:8025

## hints

* For docker-compose, visit https://github.com/docker/compose/releases
* For docker, visit https://github.com/moby/moby/releases
* You can choose the version of phpList to run with the PHPLIST_VERSION variable in .env

To reset the admin password run

``docker exec phplist_dbhost mysql -u[DBUSER] -p[DBPASS] [DBNAME] -e 'update phplist_admin set password = "NEWPASSWORD"'``


## development.

To use this docker setup for development of phpList, phpList themes or phpList plugins visit https://resources.phplist.com/develop/docker

Here is a [quick script](https://github.com/phpList/phplist-docker/blob/master/setup.sh) to show how to set up a development environment.


## database

* To reset the database run

```docker system prune -f
docker volume rm phplist-docker_dbhost_data
```

and then restart phpList-docker

* To load your own data into the database, take a DB snapshot, eg "phplist.sql.gz" and run

```gunzip -c phplist.sql.gz | docker exec -i phplist_dbhost mysql mysql -u[DBUSER] -p[DBPASS] [DBNAME]```
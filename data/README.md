#Building of containers with test data

This will build a data container, which has the data inside the container. As a result, the data will reset when you restart the container. This is only for development and test purposes, and serves no purpose for real production systems. Production systems will want to have the data on a volume, which  is then preserved.


## building a data container has two stages

### Stage 1
 
Set the data to use in the Dockerfile with the 
COPY XXX /data.sql.gz line

Run

    docker build -f Dockerfile -t phplist/testdata:base .

Then

    docker run -eMYSQL_ROOT_PASSWORD=[password] [imageID]
    
This will take a while to build the database from the data source.


### Stage 2

As the data may be quite big, you can save the image created like that
with a new tag, while the container is running

    docker commit -t phplist/testdata:mytag [containerID]
    
You can also enter the container to do some tweaks before you use the commit command.

    docker exec -it [containerID] bash
    
    
    
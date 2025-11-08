# SimpleIPAM 

super lite version of the original created by https://github.com/kuritaka 

its a very very simple tool to manage your home network/lab ip allocations

## Docker 

steps to run with a local ipam.db and a directory for your own content

### Run with local ipam.db

create a blank ipam.db file and simpleipam will import a demo database on start up

```
touch ipam.db 
docker run --name simpleipam  \ 
--restart always  \
-v ./ipam.db:/simpleipam/sqlite/ipam.db \ 
-p 888:888 \ 
-d ghcr.io/teamzuzu/simpleipam:master
```
then goto yourdockerip:888 to access the interface

### Run with your own index page / documentation links 

you can add a index.html and files for some local documentation / network diagrams etc

```
mkdir local
echo "foo" > local/index.html
docker run --name simpleipam  \
--restart always  \
-v ./ipam.db:/simpleipam/sqlite/ipam.db \
-v ./local/:/simpleipam/local/ \
-p 888:888 \
-d ghcr.io/teamzuzu/simpleipam:master
```

to use images reference using the /local/ path like this

```
<img src=/local/yeah.png>§
```


### Docker compose

you'll need to touch ipam.db and mkdir local and create an index.html

```
services:
  simpleipam:
    container_name: simpleipam
    restart: always
    volumes:
      - ./ipam.db:/simpleipam/sqlite/ipam.db
      - ./local/:/simpleipam/local/
    ports:
      - 888:888
    image: ghcr.io/teamzuzu/simpleipam:master
networks: {}
```


## Changes

* small sqllite schema changes after the addition of MAC's by https://github.com/dimxyp 

* much clean up and simplification / removal of CodeIgnite stuff not required for this usecase 

* support for a "uploaded" page to include eg a basic network diagram

* container image and examples for docker kubernetes etc ( coming soon ) 


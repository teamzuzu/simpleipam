# SimpleIPAM 

super lite version of the original created by https://github.com/kuritaka 

its a very very simple tool to manage your home network/lab

## Docker 

steps to run with a local ipam.db and a directory for your own content

### Run with local ipam.db

```
touch ipam.db ; docker run --name simpleipam --restart always  -v ./ipam.db:/simpleipam/sqlite/ipam.db -p 888:888 -d ghcr.io/teamzuzu/simpleipam:master
```

## Changes

* small sqllite schema changes after the addition of MAC's by https://github.com/dimxyp 

* much clean up and simplification / removal of CodeIgnite stuff not required for this usecase 

* support for a "uploaded" page to include eg a basic network diagram

* container image and examples for docker kubernetes etc ( coming soon ) 


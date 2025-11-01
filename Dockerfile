FROM ghcr.io/teamzuzu/zuzu-devops:main
RUN apt update  && apt install php nginx sqlite
RUN mkdir /simpleipam
COPY * /simpleipam

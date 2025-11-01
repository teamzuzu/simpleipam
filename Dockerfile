FROM ghcr.io/teamzuzu/zuzu-devops:main
RUN apt update  && apt-get install -yq php php-sqlite3
RUN mkdir /simpleipam
COPY . /simpleipam

FROM debian:stable-slim
ENV DEBIAN_FRONTEND=noninteractive
RUN apt update  && apt-get install --no-install-recommends -yq php-cli php-sqlite3 sqlite3
RUN mkdir /simpleipam
COPY . /simpleipam
CMD /simpleipam/start.sh

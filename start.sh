#!/usr/bin/env bash 
set -x
cd /simpleipam
export START_URL='http://zuzu:888' 
php -S 0.0.0.0:888 -t /simpleipam 

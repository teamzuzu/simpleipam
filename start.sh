#!/usr/bin/env bash 
set -x
cd /simpleipam/sqlite/
./init_db.sh
php -S 0.0.0.0:888 -t /simpleipam 

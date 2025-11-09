#!/usr/bin/env bash 
cd /simpleipam/sqlite/
./init_db.sh
PHP_CLI_SERVER_WORKERS=4
php -S 0.0.0.0:888 -t /simpleipam 

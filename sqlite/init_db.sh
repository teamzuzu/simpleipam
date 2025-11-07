#!/usr/bin/env bash 

# args
ARG=$1

# defines
DB='ipam.db'
DEMO_DB='demo.sql'

# check demo.sql exists
if [[ ! -f $DEMO_DB ]]; then
 echo $DEMO_DB not found
 exit
fi

init_db(){
  echo "importing ${DEMO_DB} to ${DB}"
  cat ${DEMO_DB} | sqlite3 ${DB}
  exit
}

# handle init arg
if [[ ${ARG} == 'init' ]]; then
  echo 'force init'
  if [[ -f $DB ]]; then
    echo 'backing up existing db'
    mv ${DB} ${DB}.bak
  fi
  init_db
fi

# normal start  
if [[ ! -s $DB ]]; then
  init_db
fi
echo  "db ready"

#!/bin/bash

path="$1"
fileName="$2"
file="$3"
DB_file_name="$4"
DB_NAME="$5"
cd /var/www/html/vpn/update
wget $path
tar -zxvf $fileName
/bin/cp -rf $file /var/www/html/vpn/
sudo chmod -R 777 /var/www/html/vpn
if [ -e "$DB_file_name" ]; then
  mysql -hlocalhost -uroot -pnopass $DB_NAME < $DB_file_name
fi
rm -rf $file
rm -rf $fileName
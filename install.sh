#!/bin/bash
apt-get install sqlite3 libsqlite3-dev
wget https://github.com/samwincott/IT-services-information/archive/master.zip 
unzip master.zip
echo -n "Enter name for new directory and press [ENTER]: "
read name
mv IT-services-information-master $name
cd $name
chown -hR www-data .
chmod -R 755 .
rm ../install.sh
rm install.sh
rm ../master.zip
service apache2 restart
echo -n "Enter username (if you don't know, enter 'root') for crontab and press [ENTER]: "
read user
crontab -l -u $user > mycron
echo "* * * * * /usr/bin/php "$PWD"/scripts/update_resolved.php" >> mycron
crontab -u $user mycron
chmod 777 scripts/update_resolved.php
rm mycron
rm README.md


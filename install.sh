#!/bin/bash
wget https://github.com/samwincott/IT-services-information/archive/master.zip 
unzip master.zip
cd IT-services-information-master/
crontab -l > mycron
echo "*/5 * * * * cd "$PWD"/scripts/ /usr/bin/php "$PWD"/scripts/update_resolved.php" >> mycron
crontab mycron
rm mycron
chown -R www-data:www-data .
chmod -r 755 .
rm install.sh
rm master.zip

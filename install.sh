#!/bin/bash
crontab -l > mycron
echo "*/5 * * * * /usr/bin/php /var/www/html/testing/scripts/update_resolved.php" >> mycron
crontab mycron
rm mycron
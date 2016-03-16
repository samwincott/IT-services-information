#!/bin/bash
crontab -l > mycron
echo "*/5 * * * * /usr/bin/php "$PWD"/scripts/update_resolved.php" >> mycron
crontab mycron
rm mycron
git clone 
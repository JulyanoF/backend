#!/bin/bash
env >> /etc/environment
cd /var/www/html && composer install
exec apache2-foreground
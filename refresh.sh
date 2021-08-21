#!/bin/sh
#php artisan cache:clear
php artisan migrate:fresh --seed
#rm -rf /var/www/casefacts/casefacts/storage/app/*

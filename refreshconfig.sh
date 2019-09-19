#!/bin/bash

php artisan optimize && php artisan cache:clear && php artisan config:clear
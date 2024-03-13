#!/bin/bash
set -e

GREEN=$(tput setaf 2)

echo "${GREEN}Running user service tests ..."

docker-compose exec user_app php artisan test

echo "${GREEN}Running notification service tests ..."

docker-compose exec notification_app php artisan test
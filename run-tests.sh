#!/bin/bash
set -e

GREEN=$(tput setaf 2)

echo "${GREEN}Running user service tests ..."

docker-compose exec users php artisan test

echo "${GREEN}Running notification service tests ..."

docker-compose exec notifications php artisan test
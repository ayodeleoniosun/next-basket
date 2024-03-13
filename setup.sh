#!/bin/bash
set -e

GREEN=$(tput setaf 2)
PINK=$(tput setaf 5)

echo "${PINK}Setting up env ..."

# Setup env variables for users service and install composer dependencies
cd src/users
cp .env.example .env
composer install --quiet

docker network create ecommerce

echo "${PINK}Building docker images ..."

# Build docker images
docker-compose build

# Spring up docker containers in detached mode
docker-compose up -d --force-recreate

echo "${PINK}Running migrations ..."

# Run database migrations for user service
docker-compose exec user_app php artisan migrate

echo "${GREEN}Set up completed!"
#!/bin/bash
set -e

GREEN=$(tput setaf 2)
PINK=$(tput setaf 5)

echo "${PINK}Setting up environment variables ..."

# Setup env variables for users service and install composer dependencies
cd src/users
cp .env.example .env
composer install --quiet

# Setup env variables for users service and install composer dependencies
cd src/notifications
cp .env.example .env
composer install --quiet

echo "${PINK}Creating ecommerce network if not exist ..."

NETWORK_NAME=ecommerce
if [ -z $(docker network ls --filter name=^${NETWORK_NAME}$ --format="{{ .Name }}") ] ; then
     docker network create ${NETWORK_NAME} ;
fi

echo "${PINK}Building docker images ..."

# Build docker images
docker-compose build

# Spring up docker containers in detached mode
docker-compose up -d --force-recreate

echo "${GREEN}Application dockerized!"
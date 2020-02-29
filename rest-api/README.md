# La Cosina

## About La Cosina

La Cosina is a social media application for sharing and playing recipes.

___

## Setup

### Laradock
- Install docker in your system.
```
cd laradock

cp env-example .env

# Run containers
docker-compose up -d nginx mysql redis

# Open the bash for the workspace
docker-compose exec workspace bash

# Should now be in the workspace
root@{id}:/var/www# composer install
```

Open the .env file and change `APP_CODE_PATH_HOST=../rest-api/`

Open `localhost`
___
### Normal
- Install [Composer](https://getcomposer.org/)
- Install Mysql 5.6
- Install PHP 7.3
```
cd rest-api
composer install
```

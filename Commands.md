# Creation

composer create-project symfony/website-skeleton:"^5.4" application

# Environment Files (.env.local, .env.test)

DATABASE_URL="mysql://root@127.0.0.1:3306/symcrm?serverVersion=mariadb-10.4.16&charset=utf8mb4"

# Database

## DB Creation

php bin/console doctrine:database:create

## DB Deletion

php bin/console doctrine:database:drop --force

## DB Schema

php bin/console doctrine:schema:update --force

# Migrations

php bin/console make:migration

php bin/console doctrine:migrations

php bin/console doctrine:migrations:migrate

php bin/console doctrine:migrations:list

# Controllers

php bin/console make:controller MiscController
php bin/console make:controller HomeController
php bin/console make:controller AdminController
php bin/console make:controller UserController
php bin/console make:controller EventController
php bin/console make:controller ContactController
php bin/console make:controller TeamController

# Models

php bin/console make:entity --regenerate "App\Entity"

php bin/console make:entity Team
php bin/console make:entity Event
php bin/console make:entity Contact

# Forms

php bin/console make:form TeamFormType
php bin/console make:form ContactFormType
php bin/console make:form EventFormType
php bin/console make:form UserFormType

# Users

php bin/console make:user

php bin/console make:entity User

# Auth

php bin/console make:auth

# Tests

## Unit Tests

### Entity Tests

php bin/console make:unit-test

- Entity\ContactTest
- Entity\EventTest
- Entity\TeamTest
- Entity\UserTest

### Functional Tests

php bin/console make:functional-test

- Controller\ContactControllerTest
- Controller\EventControllerTest
- Controller\TeamControllerTest
- Controller\UserControllerTest

# Dependencies

composer require --dev orm-fixtures
composer require --dev dama/doctrine-test-bundle

composer require symfony/twig-pack

# Heroku (Deployment)

## Version (installed)

heroku -v

## Login

heroku login -i

## Creation

heroku create symcrm-lh

## Git

### Remote (check)

git remote -v

### Add repository

heroku git:remote -a symcrm-lh

### Buildpack

heroku buildpacks:set heroku/php

### Environment variables

heroku config:set APP_ENV=prod

### Update

git push heroku main

# PHP 8

## Installation

sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update

sudo apt install php8.0
sudo apt install php8.0-common php8.0-fpm php8.0-mysql php8.0-gmp php8.0-xml php8.0-xmlrpc php8.0-curl php8.0-mbstring php8.0-gd php8.0-dev php8.0-imap php8.0-opcache php8.0-readline php8.0-soap php8.0-zip php8.0-intl php8.0-cli libapache2-mod-php8.0

## Restart

sudo systemctl restart php8.0-fpm.service

## Version

php -v

## Apache

### Disable V7

sudo a2dismod php7.4

### Enable V8

sudo a2enmod php8.0

### Restart

sudo systemctl restart apache2.service
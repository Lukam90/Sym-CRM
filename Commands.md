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

### Update

git push heroku main
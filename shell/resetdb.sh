cd migrations

rm Version*

php bin/console make:migration
php bin/console doctrine:migrations:migrate
command="doctrine:query:sql"
truncate="SET FOREIGN_KEY_CHECKS = 0; TRUNCATE TABLE"

php bin/console $command "$truncate team"
php bin/console $command "$truncate contact"
php bin/console $command "$truncate event"
php bin/console $command "$truncate user"

command="doctrine:fixtures:load"

php bin/console $command
php bin/console $command --env=test
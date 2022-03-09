doctrine="php bin/console doctrine"

$doctrine:database:drop --force --env=test

$doctrine:database:create --env=test

$doctrine:schema:update --force --env=test

$doctrine:migrations:migrate --env=test
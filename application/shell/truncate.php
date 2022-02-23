<?php 

$nocheck = "SET FOREIGN_KEY_CHECKS = 0;";
$truncate = "$nocheck TRUNCATE TABLE ";

$doctrine = "php bin/console doctrine";
$command = "$doctrine:query:sql";
$fixtures = "$doctrine:fixtures:load";

$query = "$command '$truncate";

exec("$query team'");
//exec("$query item'");

echo "Les tables ont bien été vidées.";

system("$fixtures");
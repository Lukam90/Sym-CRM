<?php 

$nocheck = "SET FOREIGN_KEY_CHECKS = 0;";
$truncate = "$nocheck TRUNCATE TABLE ";

$doctrine = "php bin/console doctrine";
$command = "$doctrine:query:sql";
$fixtures = "$doctrine:fixtures:load";

$query = "$command '$truncate";

$tables = ["team", "contact"];

foreach ($tables as $table) {
    exec("$query $table'");
}

echo "Les tables ont bien été vidées.";

system("$fixtures");
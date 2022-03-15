sql="doctrine:query:sql"
load="doctrine:fixtures:load"

truncate="SET FOREIGN_KEY_CHECKS = 0; TRUNCATE TABLE"

# Normal

php bin/console $sql "$truncate symcrm.team"
php bin/console $sql "$truncate symcrm.contact"
php bin/console $sql "$truncate symcrm.event"
php bin/console $sql "$truncate symcrm.user"

php bin/console $load

# Test

php bin/console $sql "$truncate symcrm_test.team"
php bin/console $sql "$truncate symcrm_test.contact"
php bin/console $sql "$truncate symcrm_test.event"
php bin/console $sql "$truncate symcrm_test.user"

php bin/console $load --env=test
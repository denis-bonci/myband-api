<?php
passthru('php bin/console doctrine:database:drop --quiet --force --if-exists --env=test');
passthru('php bin/console doctrine:database:create --quiet --env=test');
passthru('php bin/console doctrine:schema:create --quiet --no-interaction --env=test');
passthru('php bin/console doctrine:fixtures:load --quiet --purge-with-truncate --no-interaction --env=test');

require __DIR__.'/vendor/autoload.php';

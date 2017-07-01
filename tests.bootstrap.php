<?php
passthru('php bin/console doctrine:database:drop --force --env=test');
passthru('php bin/console doctrine:database:create --env=test');
passthru('php bin/console doctrine:schema:create --env=test');
passthru('php bin/console doctrine:fixtures:load --purge-with-truncate --no-interaction --env=test');

require __DIR__.'/vendor/autoload.php';

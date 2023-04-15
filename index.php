<?php
require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

Use UI\CusthomeUpdateLotsCommand;

$application = new Application();
$application->add(new CusthomeUpdateLotsCommand(new \Domain\LotRepository()));
$application->run();

<?php
require __DIR__.'/vendor/autoload.php';

use Domain\Lot;
use Domain\LotRepository;
use League\Flysystem\Filesystem;
use Symfony\Component\Console\Application;

Use UI\CusthomeUpdateLotsCommand;

// Configure Flysystem for local filesystem
$adapter = new \League\Flysystem\Local\LocalFilesystemAdapter(__DIR__);

// ! Uncomment following lines to use Locastack S3
//$config = \AsyncAws\Core\Configuration::create([
//    'endpoint' => 'http://localhost:4566',
//    'pathStyleEndpoint' => true,
//]);
//
//$client = new \AsyncAws\S3\S3Client($config);
//$adapter = new \League\Flysystem\AsyncAwsS3\AsyncAwsS3Adapter(
//    $client,
//    'custhome',
//);

$filesystem = new Filesystem($adapter);

$application = new Application();
$application->add(new CusthomeUpdateLotsCommand(
    new LotRepository([
        new Lot('A'),
        new Lot('B', available: false),
        new Lot('C'),
        new Lot('D'),
        new Lot('E', available: false),
    ]),
    $filesystem
));
$application->run();

<?php

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Finder\Finder;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'   => 'sqlite',
    'database' => ':memory:',
    'prefix'   => '',
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();

$finder = new Finder;

$migrations = $finder->files()->name('create_*_table.php')->in(__DIR__ . '/migrations');

foreach ($migrations as $migration) {
    require_once $migration->getRealPath();
}

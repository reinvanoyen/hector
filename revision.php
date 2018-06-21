<?php

require __DIR__ . '/app/init.php';

$manager = new \Hector\Migration\Migrator(new \Hector\Migration\FileVersionStorage('app/version.txt'));
$manager->addRevision(new \App\Migration\CreatePageTable());
$manager->addRevision(new \App\Migration\CreateProjectTable());
$manager->migrate();

echo 'ok';
<?php

require __DIR__ . '/App/init.php';

$manager = new \Hector\Migration\Manager(new \Hector\Migration\FileVersionStore('App/version.txt'));
$manager->addRevision(new \App\Migration\CreatePageTable());
$manager->addRevision(new \App\Migration\CreateProjectTable());
$manager->reset();

echo 'ok';
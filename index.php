<?php

ini_set( 'display_errors', 1 );

require __DIR__ . '/vendor/autoload.php';

$app = new Hector\Core\Application( 'App' );

$app->get( '(?<id>\d+)/', 'App.MyController.index' );

$app->start();
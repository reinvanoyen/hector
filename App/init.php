<?php

namespace App;

use Hector\Core\Application;
use Hector\Core\Http\Middleware\AfterMiddleware;
use Hector\Core\Http\Middleware\BeforeMiddleware;

define( 'App\\HOST', 'rein.tnt.lan' );
define( 'App\\ROOT', '/hector/' );

$app = new Application( 'Example' );

$app->get( '(?<page_slug>.+)/(?<page_id>\d+)/', 'Pages.test' );

$app->get( '(?<page_slug>.+)/(?<page_id>\d+)/', 'Pages.view' )
	->add( new BeforeMiddleware() )
	->add( new AfterMiddleware() )
;

$app->start();
<?php

namespace App;

use Aegis\Template;
use Hector\Core\Application;
use Hector\Core\Http\Middleware\AfterMiddleware;
use Hector\Core\Http\Middleware\BeforeMiddleware;

// Config

\Aegis\Template::$debug = TRUE;
\Aegis\Template::$cacheDirectory = 'App/Example/cache/templates/';
\Aegis\Template::$templateDirectory = 'App/Example/View/';

// Set some CONSTANTS

define( 'App\\HOST', 'rein.tnt.lan' );
define( 'App\\ROOT', '/hector/' );

// Create the application

$app = new Application( 'Example' );

$app->get( '', 'Pages.index' );

$app->group( 'users/', function() use ( $app ) {

	$app->get( '', 'Users.index' );
	$app->get( 'login/', 'Users.login' );
} );

$app->start();
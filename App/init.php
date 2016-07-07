<?php

namespace App;

use Hector\Core\Application;
use Hector\Core\Http\Middleware\AfterMiddleware;
use Hector\Core\Http\Middleware\BeforeMiddleware;

// Config

\Aegis\Template::$debug = FALSE;
\Aegis\Template::$cacheDirectory = 'App/Example/cache/templates/';
\Aegis\Template::$templateDirectory = 'App/Example/View/';

// Set some CONSTANTS

define( 'App\\HOST', 'rein.tnt.lan' );
define( 'App\\ROOT', '/hector/' );

// Create the application

$app = new Application( 'Example' );

$app->get( '', function( $req, $res ) {

	return 'Welcome';
} );

$app->group( 'users/', function() use ( $app ) {

	$app->get( '', function( $req, $res ) {

		return 'Users index';
	} );

	$app->get( 'login/', 'Users.login' );

} )->add( [ new AfterMiddleware(), new BeforeMiddleware() ] );

$app->start();
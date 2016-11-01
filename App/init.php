<?php

namespace App;

use Aegis\Template;
use Hector\Core\Application;

// Config

Template::$debug = TRUE;
Template::$cacheDirectory = 'App/Example/cache/templates/';
Template::$templateDirectory = 'App/Example/View/';

// Create the application

$app = new Application( 'Example' );

$app->get( '', 'Pages.index' );
$app->post( '', 'Pages.validateLogin' );

$app->group( 'users/', function() use ( $app ) {

	$app->get( '', 'Users.index' );
	$app->get( 'login/', 'Users.login' );
	$app->get( 'profile/(?<id>\d+)/(?<slug>.+)/', 'Users.viewProfile' );
} );

$app->start();
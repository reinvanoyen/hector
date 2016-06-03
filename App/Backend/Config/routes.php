<?php

namespace App\Backend\Config;

use Hector\Core\Routing\Router;

Router::prefix( 'driecms/', function() {

	Router::get( '(.*)', 'Backend.route' );
} );

Router::prefix( 'api/1.0/', function() {

	Router::get( 'module/', 'Api.getModule' );
} );
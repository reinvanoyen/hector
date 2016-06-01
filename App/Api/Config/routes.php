<?php

namespace App\Api\Config;

use Hector\Core\Routing\Router;

Router::prefix( 'api/1.0/', function() {

	Router::get( 'index/', 'Api.getIndex' );
	Router::get( 'save/', 'Api.save' );
} );
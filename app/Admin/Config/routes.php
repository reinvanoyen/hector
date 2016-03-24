<?php

namespace App\Admin\Config;

use Hector\Core\Routing\Router;

Router::prefix( 'admin/', function()
{
	Router::get( '', 'Admin.index' );
} );
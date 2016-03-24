<?php

namespace Admin\Config;

use Hector\Core\Router;

Router::prefix( 'admin/', function()
{
	Router::get( '', 'Admin.index' );
} );
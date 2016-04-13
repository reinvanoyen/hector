<?php

namespace App\ExampleApp\Config;

use Hector\Core\Routing\Router;

Router::get( '', 'Blog.viewIndex' );
Router::get( '(?<id>\d+)-(?<slug>.+)/', 'Blog.viewPost' );
Router::get( 'querytest/', 'QueryTest.viewIndex' );
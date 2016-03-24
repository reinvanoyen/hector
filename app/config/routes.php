<?php

namespace app\packages\main\config;

use hector\core\Router;

Router::get( '', 'Pages.home' );
Router::get( 'over-ons/', 'Pages.viewAboutUs' );
Router::get( 'json/', 'Pages.json' );
Router::get( 'redirect/', 'Pages.redirect' );

Router::prefix( 'blog/', function()
{
	Router::get( '', 'Blog.index' );
	Router::get( '(?<blog_id>\d+)/', 'Blog.viewPost' );
} );
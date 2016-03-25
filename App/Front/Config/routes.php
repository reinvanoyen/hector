<?php

namespace App\Front\Config;

use Hector\Core\Routing\Router;

Router::get( '', 'Pages.viewHome' );
Router::get( 'redirect/', 'Pages.redirect' );
Router::get( '(?<slug>.+)/', 'Pages.view' );
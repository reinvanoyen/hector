<?php

namespace App\Config;

use Hector\Core\Router;

Router::get( '', 'Pages.home' );
Router::get( 'over-ons/', 'Pages.viewAboutUs' );
Router::get( 'json/', 'Pages.json' );
Router::get( 'redirect/', 'Pages.redirect' );
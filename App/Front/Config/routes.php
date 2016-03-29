<?php

namespace App\Front\Config;

use Hector\Core\Routing\Router;

Router::get( '(?<id>\d+)/', 'Pages.view' );
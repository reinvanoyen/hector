<?php

namespace App\Backend\Config;

use Hector\Core\Routing\Router;

Router::get( '(?<page_slug>.+)/', 'Pages.view' );
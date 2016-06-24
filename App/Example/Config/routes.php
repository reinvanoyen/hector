<?php

namespace App\Backend\Config;

use Hector\Core\Routing\Router;

Router::get( '(?<page_title>.+)/', 'Pages.view' );
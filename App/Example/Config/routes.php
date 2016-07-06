<?php

namespace App\Backend\Config;

use Hector\Core\Routing\Router;

Router::get( '(?<page_slug>.+)/(?<page_id>\d+)/', 'Pages.test' );
Router::get( '(?<page_slug>.+)/(?<page_id>\d+)/', 'Pages.view' );
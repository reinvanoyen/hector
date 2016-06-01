<?php

namespace App\ExampleApp\Config;

use Hector\Core\Db\ConnectionManager;

ConnectionManager::create( 'localhost', 'root', '', 'hector' );
<?php

namespace App;

use Hector\Core\App;
use Hector\Core\Bootstrap;

define( 'App\\HOST', 'rein.tnt.lan' );
define( 'App\\ROOT', '/hector/' );

$app = new App( 'Example' );
$app->run();
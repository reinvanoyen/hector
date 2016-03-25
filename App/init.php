<?php

namespace App;

use Hector\Core\Bootstrap;

define( 'App\\HOST', 'rein.tnt.lan' );
define( 'App\\ROOT', 'hector/' );

Bootstrap::registerApp( 'Front' );
Bootstrap::registerApp( 'Admin' );

Bootstrap::start();
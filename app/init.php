<?php

namespace App;

use Hector\Core\Bootstrapper;

define( 'App\\HOST', 'rein.tnt.lan' );
define( 'App\\ROOT', 'hector/' );

Bootstrapper::registerApp( 'Front' );
Bootstrapper::registerApp( 'Admin' );

Bootstrapper::start();
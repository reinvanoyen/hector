<?php

namespace Hector;

function autoloader( $classname )
{
	$classname = ltrim( $classname, '\\' );
	include_once str_replace( '\\', '/', $classname ) . '.php';
}

spl_autoload_register( 'Hector\\autoloader' );
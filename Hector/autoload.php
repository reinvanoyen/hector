<?php

namespace Hector;

use Hector\Helpers\String;

function autoloader( $classname )
{
	if( String\startsWith( $classname, 'Hector' )|| String\startsWith( $classname, 'App' ) ) {

		$classname = ltrim( $classname, '\\' );
		include_once str_replace( '\\', '/', $classname ) . '.php';
	}
}

spl_autoload_register( 'Hector\\autoloader' );
<?php

namespace Hector;

header( 'X-Powered-By: Hector' );

function autoloader( $classname )
{
	$classname = ltrim( $classname, '\\' );
	include_once str_replace( '\\', '/', $classname ) . '.php';
}

class PHPException extends \Exception
{
	public static function handleError( $no, $message, $file, $line )
	{
		throw new self( $message );
	}
}

function exceptionHandler( /*\Exception*/ $exception )
{
	try
	{
		ob_end_clean();
	}
	catch( \Exception $e ) {}

	echo $exception->getMessage();

	exit;
}

function bootstrap()
{
	set_error_handler( [ '\\Hector\\PHPException', 'handleError' ] );
	set_exception_handler( 'Hector\\exceptionHandler' );
	spl_autoload_register( 'Hector\\autoloader' );

	require_once 'Hector/Helpers/string.php';
	require_once 'Hector/Helpers/regex.php';
}

function start()
{
	\Hector\Core\Routing\Router::route( new \Hector\Core\Http\Request() );
}

function initPackage( $app )
{
	\Hector\Core\Routing\Router::reset();
	\Hector\Core\Runtime::setPackage( $app );
	require_once 'App/' . $app . '/init.php';
	start();
}

bootstrap();
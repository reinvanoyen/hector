<?php

namespace hector;

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
	set_error_handler( array( '\\hector\\PHPException', 'handleError' ) );
	set_exception_handler( 'hector\\exceptionHandler' );
	spl_autoload_register( 'hector\\autoloader' );

	require_once 'hector/helpers/string.php';
	require_once 'hector/helpers/regex.php';
}

function start()
{
	\hector\core\Router::route( new \hector\core\http\Request() );
}

bootstrap();
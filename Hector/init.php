<?php

namespace Hector;

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

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

function init()
{
	set_error_handler( [ '\\Hector\\PHPException', 'handleError' ] );
	set_exception_handler( 'Hector\\exceptionHandler' );

	require_once 'Hector/autoload.php';
	require_once 'Hector/Helpers/Type.php';
	require_once 'Hector/Helpers/String.php';
	require_once 'Hector/Helpers/Regex.php';
}

init();
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
	try {

		ob_end_clean();

	} catch( \Exception $e ) {}

	echo '<pre>';
	echo $exception->getMessage();
	echo '<br />';
	echo $exception->getFile();
	echo '<br />';
	echo $exception->getLine();
	$trace = $exception->getTraceAsString();
	echo htmlspecialchars( $trace );
	echo '</pre>';

	exit;
}

function init()
{
	set_exception_handler( 'Hector\\exceptionHandler' );

	require __DIR__ . '/../vendor/autoload.php';
	require_once __DIR__ . '/Core/Autoloader.php';

	$autoloader = new Autoloader();
	$autoloader->addNamespace( 'Hector', 'Hector/' );
	$autoloader->addNamespace( 'App', 'App/' );
	$autoloader->register();

	require_once __DIR__ . '/Helpers/Http.php';
	require_once __DIR__ . '/Helpers/Type.php';
	require_once __DIR__ . '/Helpers/String.php';
	require_once __DIR__ . '/Helpers/Regex.php';
}

init();
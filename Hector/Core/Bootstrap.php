<?php

namespace Hector\Core;

use Hector\Core\Routing\Found;

class Bootstrap
{
	private static $current_app;
	private static $apps = [];

	public static function registerApp( $name )
	{
		self::$apps[] = new App( $name );
	}

	public static function getCurrentApp()
	{
		return self::$current_app;
	}

	public static function start()
	{
		$nothing_found = TRUE;

		try
		{
			foreach( self::$apps as $a )
			{
				self::$current_app = $a;
				$a->run();
			}
		}
		catch( Found $e )
		{
			$nothing_found = FALSE;
		}

		if( $nothing_found )
		{
			echo 'Error 404';
		}
	}
}
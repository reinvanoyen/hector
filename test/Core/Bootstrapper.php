<?php

namespace Hector\Core;

class Bootstrapper
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
		foreach( self::$apps as $a )
		{
			self::$current_app = $a;
			$a->run();
		}

		echo 'Error 404';
	}
}
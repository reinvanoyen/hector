<?php

namespace Hector\Core;

abstract class Session
{
	private static $data;

	public static function start( String $name )
	{
		session_name( $name );
		session_start();

		self::$data =& $_SESSION;

		if( ! self::has( 'csrf' ) ) {
			self::set( 'csrf', random_bytes( 64 ) );
		}
	}

	public static function has( $key )
	{
		return isset( $_SESSION[ $key ] );
	}

	public static function set( $key, $value )
	{
		self::$data[ $key ] = $value;
	}

	public static function get( $key )
	{
		return $_SESSION[ $key ];
	}

	public static function stop()
	{
		session_destroy();
	}
}

<?php

namespace hector\core;

abstract class Router
{
	public static $routes = array();

	public static function register( $pattern, $action )
	{
		self::$routes[ $pattern ] = $action;
	}

	public static function route( $request )
	{
		foreach( self::$routes as $pattern => $action )
		{
			if( $pattern === $request->path )
			{
				$response = call_user_func( 'app\\controller\\' . $action, $request );

				if( $response instanceof \hector\core\http\Response )
				{
					$response->execute();
					return;
				}
			}
		}
	}
}
<?php

namespace hector\core;

abstract class Router
{
	public static $prefix;
	public static $routes = [];

	public static function get( $pattern, $action )
	{
		self::$routes[ self::$prefix . $pattern ] = $action;
	}

	public static function prefix( $prefix, $callback )
	{
		self::$prefix = $prefix;
		$callback();
		self::$prefix = NULL;
	}

	public static function route( $request )
	{
		foreach( self::$routes as $pattern => $action )
		{
			if( preg_match( '@^(' . $pattern . ')$@', $request->path, $matches ) )
			{
				$args = [];
				foreach( $matches as $k => $v )
				{
					if( is_string( $k ) )
					{
						$args[] = $v;
					}
				}

				if( is_callable( $action ) )
				{
					$callable = $action;
				}
				else
				{
					$parts = explode( '.', $action );
					$controller = 'app\\controller\\' . $parts[ 0 ];
					$method = $parts[ 1 ];
					$controller = new $controller();

					$callable = [ $controller, $method ];
				}

				$response = call_user_func_array( $callable, $args );

				if( $response instanceof \hector\core\http\Response )
				{
					$response->execute();
					return;
				}

				if( is_string( $response ) )
				{
					echo $response;
					return;
				}
			}
		}
	}
}
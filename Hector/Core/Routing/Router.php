<?php

namespace Hector\Core\Routing;

use Hector\Core\Bootstrap;
use Hector\Core\Http\Response\AbstractResponse;
use Hector\Core\Http\Request;
use Hector\Helpers\Regex;

abstract class Router
{
	private static $prefix;
	private static $routes = [];

	private static function register( $method, $pattern, $action )
	{
		if( ! isset( self::$routes[ $method ] ) ) {

			self::$routes[ $method ] = [];
		}

		self::$routes[ $method ][ self::$prefix . $pattern ] = $action;
	}

	public static function reset()
	{
		self::$routes = [];
	}

	public static function prefix( $prefix, $cb )
	{
		self::$prefix = $prefix;
		$cb();
		self::$prefix = NULL;
	}

	public static function getRoutesForRequest( Request $request )
	{
		if( isset( self::$routes[ $request->method ] ) ) {

			return self::$routes[ $request->method ];
		}

		return FALSE;
	}

	public static function route( Request $request )
	{
		$routes = self::getRoutesForRequest( $request );

		assert( $routes );

		foreach( $routes as $pattern => $action ) {

			if( Regex\namedPregMatch( '@^(' . $pattern . ')$@', $request->path, $matches ) ) {

				$args = $matches;
				$controller = NULL;

				if( is_callable( $action ) ) {

					$callable = $action;
				} else {

					$parts = explode( '.', $action );
					$controller = 'App\\' . Bootstrap::getCurrentApp()->getName() . '\\Controller\\' . $parts[ 0 ];
					$method = $parts[ 1 ];
					$controller = new $controller( $request );

					$callable = [ $controller, $method ];
				}

				try {

					if( $controller ) {

						$controller->beforeExecuteRoute();
					}

					$response = call_user_func_array( $callable, $args );

					self::executeResponse( $response, $controller );

					throw new Found();

				} catch( NotFound $e ) {

					continue;

				} finally {

					if( $controller ) {

						$controller->afterExecuteRoute();
					}
				}
			}
		}
	}

	public static function executeResponse( $response, $controller )
	{
		if( $controller ) {

			$controller->beforeAction();
		}

		if( is_string( $response ) ) {

			echo $response;
		}

		if( $response instanceof AbstractResponse ) {

			$response->execute();
		}

		if( $controller ) {

			$controller->afterAction();
		}
	}

	public static function get( $pattern, $action ) { self::register( 'GET', $pattern, $action ); }
	public static function post( $pattern, $action ) { self::register( 'POST', $pattern, $action ); }
	public static function delete( $pattern, $action ) { self::register( 'DELETE', $pattern, $action ); }
	public static function put( $pattern, $action ) { self::register( 'PUT', $pattern, $action ); }
}
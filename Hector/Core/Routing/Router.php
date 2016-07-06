<?php

namespace Hector\Core\Routing;

use Hector\Core\Bootstrap;
use Hector\Core\Http\Psr\Response;
use Hector\Helpers\Regex;
use Hector\Core\Http\Response\AbstractResponse;
use Psr\Http\Message\ServerRequestInterface;

abstract class Router
{
	private static $prefix;
	private static $routes = [];

	public static function reset()
	{
		self::$routes = [];
	}

	public static function prefix( $prefix, $callable )
	{
		self::$prefix = $prefix;
		$callable();
		self::$prefix = NULL;
	}
	
	public static function route( ServerRequestInterface $request )
	{
		$routes = NULL;

		if( isset( self::$routes[ $request->getMethod() ] ) ) {

			$routes = self::$routes[ $request->getMethod() ];
		}
		
		assert( $routes );
		
		foreach( self::$routes as $route ) {

			if( ( $matches = $route->match( $request ) ) !== FALSE ) {

				try {

					$response = $route->execute( $request );

					return $response;

				} catch( NotFound $e ) {

					continue;
				}
			}
		}

		return new Response( 404 );
	}

	public static function get( $pattern, $action ) { self::register( 'GET', $pattern, $action ); }
	public static function post( $pattern, $action ) { self::register( 'POST', $pattern, $action ); }
	public static function delete( $pattern, $action ) { self::register( 'DELETE', $pattern, $action ); }
	public static function put( $pattern, $action ) { self::register( 'PUT', $pattern, $action ); }

	private static function register( $method, $pattern, $action )
	{
		if( ! isset( self::$routes[ $method ] ) ) {

			self::$routes[ $method ] = [];
		}

		self::$routes[ $method ] = new Route( self::$prefix . $pattern, $action );
	}
}
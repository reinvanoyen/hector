<?php

namespace Hector\Core\Routing;

use Hector\Core\Http\Response;
use Hector\Helpers\Regex;
use Psr\Http\Message\ServerRequestInterface;

class Router
{
	private $prefix;
	private $routes = [];

	public function group( $prefix, $callable )
	{
		$this->prefix = $prefix;
		$callable();
		$this->prefix = NULL;
	}

	public function route( ServerRequestInterface $request )
	{
		$routes = NULL;

		if( isset( $this->routes[ $request->getMethod() ] ) ) {

			$routes = $this->routes[ $request->getMethod() ];
		}

		foreach( $this->routes as $route ) {

			if( ( $matches = $route->match( $request ) ) !== FALSE ) {

				try {

					return $route->execute( $request, new Response( 200 ) );

				} catch( NotFound $e ) {

					continue;
				}
			}
		}

		return new Response( 404 );
	}

	private function register( $method, $pattern, $action )
	{
		if( ! isset( $this->routes[ $method ] ) ) {

			$this->routes[ $method ] = [];
		}

		$route = new Route( $this->prefix . $pattern, $action );

		$this->routes[ $method ] = $route;

		return $route;
	}

	public function get( $pattern, $action ) { return $this->register( 'GET', $pattern, $action ); }
	public function post( $pattern, $action ) { return $this->register( 'POST', $pattern, $action ); }
	public function delete( $pattern, $action ) { return $this->register( 'DELETE', $pattern, $action ); }
	public function put( $pattern, $action ) { return $this->register( 'PUT', $pattern, $action ); }
}
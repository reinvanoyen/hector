<?php

namespace Hector\Core\Routing;

use Hector\Core\Http\Response;
use Hector\Helpers\Regex;
use Psr\Http\Message\ServerRequestInterface;

class Router
{
	use RouteableTrait;

	private $groups = [];

	public function route( ServerRequestInterface $request )
	{
		$method = $request->getMethod();
		$routes = $this->getRoutesForMethod( $method );

		foreach( $this->groups as $group ) {

			$routes = array_merge( $routes, $group->getRoutesForMethod( $method ) );
		}

		foreach( $routes as $route ) {

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

	public function group( $prefix, $callable )
	{
		$group = new Group( $prefix );

		$this->groups[] = $group;

		$this->registeringParent = $group;

		$callable();

		$parent = $this->registeringParent;

		$this->registeringParent = NULL;

		return $parent;
	}
}
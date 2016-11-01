<?php

namespace Hector\Core\Routing;

use Hector\Core\Http\Middleware\MiddlewareInterface;

class Group
{
	use RouteableTrait;

	public function __construct( $prefix = '' )
	{
		$this->setPrefix( $prefix );
	}

	public function add( $middleware )
	{
		foreach( $this->routes as $method => $routes ) {

			foreach( $routes as $route ) {

				$route->add( $middleware );
			}
		}

		return $this;
	}
}
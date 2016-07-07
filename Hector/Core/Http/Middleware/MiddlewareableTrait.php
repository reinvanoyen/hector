<?php

namespace Hector\Core\Http\Middleware;

use Closure;

trait MiddlewareableTrait
{
	private $middleware;

	public function add( MiddlewareInterface $middleware )
	{
		$this->middleware[] = $middleware;

		return $this;
	}

	public function runMiddlewareStack( $request, $response, Closure $core )
	{
		$coreFunction = $this->createCoreFunction( $core );

		$middleware = array_reverse( $this->middleware );

		$full = array_reduce( $middleware, function( $nextMiddleware, $middleware ) {

			return $this->createMiddlewareFunction( $nextMiddleware, $middleware );

		}, $coreFunction);

		return $full( $request, $response );
	}

	private function createMiddlewareFunction( $nextMiddleware, $middleware )
	{
		return function( $request, $response ) use( $nextMiddleware, $middleware ) {

			return call_user_func_array( [ $middleware, 'handle'], [ $request, $response, $nextMiddleware ] );
		};
	}

	private function createCoreFunction( Closure $core )
	{
		return function( $request, $response ) use ( $core ) {

			return call_user_func_array( $core, [ $request, $response ] );
		};
	}
}
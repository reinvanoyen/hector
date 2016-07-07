<?php

namespace Hector\Core\Routing;

use Closure;
use Hector\Helpers\Regex;
use Hector\Core\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Hector\Core\Http\Middleware\MiddlewareableTrait;

class Route
{
	use MiddlewareableTrait;

	private $pattern;
	private $action;
	private $attributes;

	public function __construct( $pattern, $action )
	{
		$this->pattern = (string) $pattern;
		$this->action = $action;
	}

	public function match( ServerRequestInterface $request )
	{
		$path = substr( $request->getUri()->getPath(), strlen( \App\ROOT ) );

		if( Regex\namedPregMatch( '@^(' . $this->pattern . ')$@', $path, $matches ) ) {

			return ( $this->attributes = $matches );
		}

		return FALSE;
	}

	private function getCallable()
	{
		if( is_callable( $this->action ) ) {

			$callable = $this->action;

		} else {

			// @TODO improve this part
			$parts = explode( '.', $this->action );
			$controller = 'App\\Example\\Controller\\' . $parts[ 0 ];
			$method = $parts[ 1 ];
			$controller = new $controller();

			$callable = [ $controller, $method ];
		}

		return $callable;
	}

	private function call( ServerRequestInterface $request, ResponseInterface $response )
	{
		return call_user_func_array( $this->getCallable(), [ $request, $response ] );
	}

	public function getCoreFunction()
	{
		return function( $request, $response ) {

			$result = $this->call( $request, $response );

			if( ! ( $result instanceof ResponseInterface ) ) {

				return $response->write( $result );
			}

			return $result;
		};
	}

	public function execute( ServerRequestInterface $request, ResponseInterface $response )
	{
		$action = $this->action;

		foreach( $this->attributes as $attrName => $attrValue ) {

			$request = $request->withAttribute( $attrName, $attrValue );
		}

		return $this->runMiddlewareStack( $request, $response, $this->getCoreFunction() );
	}
}
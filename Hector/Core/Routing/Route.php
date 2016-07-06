<?php

namespace Hector\Core\Routing;

use Hector\Core\Bootstrap;
use \Hector\Helpers\Regex;
use Psr\Http\Message\ServerRequestInterface;

class Route
{
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

	public function execute( ServerRequestInterface $request )
	{
		foreach( $this->attributes as $attrName => $attrValue ) {

			$request = $request->withAttribute( $attrName, $attrValue );
		}

		if( is_callable( $this->action ) ) {

			$callable = $this->action;

		} else {

			// @TODO improve this part
			$parts = explode( '.', $this->action );
			$controller = 'App\\Example\\Controller\\' . $parts[ 0 ];
			$method = $parts[ 1 ];
			$controller = new $controller( $request );

			$callable = [ $controller, $method ];
		}

		return $response = call_user_func_array( $callable, $request->getAttributes() );
	}
}

/*
 *
 * 		foreach( $routes as $pattern => $action ) {

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
 * */
<?php

namespace Hector\Core;

use Hector\Core\Routing\Router;
use Hector\Core\Http\Psr\ServerRequest;
use Psr\Http\Message\ResponseInterface;

class Application
{
	private $router;

	public function __construct()
	{
		$this->router = new Router();
	}

	public function start()
	{
		$response = $this->router->route( ServerRequest::fromGlobals() );
		$this->respond( $response );
	}

	private function respond( ResponseInterface $response )
	{
		if( ! headers_sent() ) {

			// Status
			header( sprintf(
				'HTTP/%s %s %s',
				$response->getProtocolVersion(),
				$response->getStatusCode(),
				$response->getReasonPhrase()
			) );

			// Headers
			foreach( $response->getHeaders() as $name => $values ) {
				foreach( $values as $value ) {
					header( sprintf( '%s: %s', $name, $value ), FALSE );
				}
			}
		}

		echo $response->getBody()->getContents();
	}

	public function get( $pattern, $callable )
	{
		return $this->router->get( $pattern, $callable );
	}

	public function post( $pattern, $callable )
	{
		return $this->router->post( $pattern, $callable );
	}

	public function put( $pattern, $callable )
	{
		return $this->router->put( $pattern, $callable );
	}

	public function delete( $pattern, $callable )
	{
		return $this->router->delete( $pattern, $callable );
	}
}
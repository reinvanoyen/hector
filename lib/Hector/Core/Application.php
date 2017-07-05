<?php

namespace Hector\Core;

use Hector\Core\DependencyInjection\Container;
use Hector\Core\Session;
use Hector\Core\Routing\Router;
use Hector\Core\Http\ServerRequest;
use Psr\Http\Message\ResponseInterface;

class Application
{
	private $directory;
	private $router;
    private $autoloader;

	public function __construct( String $directory )
	{
        $this->directory = $directory;

        // Intantiate the router
        $this->router = new Router();

        // Create our container
        $this->container = new Container();

        // Create the autoloader
		$this->autoloader = new Autoloader();
        $this->autoloader->addNamespace( $this->directory, $this->directory . '/' );
        $this->autoloader->register();
	}

	public function start()
	{
        // Start the session
        Session::start( $this->directory );

        // Get the response
        $response = $this->router->route( ServerRequest::fromGlobals() );

        // Respond
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

	public function group( $name, $callable )
	{
		return $this->router->group( $name, $callable );
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

require_once __DIR__ . '/../init.php';
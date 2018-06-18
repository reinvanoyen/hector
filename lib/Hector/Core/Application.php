<?php

namespace Hector\Core;

use Hector\Core\DependencyInjection\Container;
use Hector\Core\Provider\RoutingServiceProvider;
use Hector\Core\Provider\ServiceProviderInterface;
use Hector\Core\Http\ServerRequest;
use Psr\Http\Message\ResponseInterface;

class Application extends Container
{
    private $namespace;
    private $autoloader;
    private $providers = [];

    public function __construct(String $namespace)
    {
        $this->namespace = $namespace;

        // Add routing
	    $this->register(new RoutingServiceProvider());

        // Create the autoloader
        $this->autoloader = new Autoloader();
        $this->autoloader->addNamespace($this->namespace, $this->namespace . '/');
        $this->autoloader->register();
    }

    public function register(ServiceProviderInterface $provider)
    {
        $this->providers[] = $provider;
	    $provider->register($this);
    }

    public function start()
    {
        // Start the session
        \Hector\Core\Session::start($this->namespace);

        // Get the response
        $response = $this->get('router')->route(ServerRequest::fromGlobals());

        // Respond
        $this->respond($response);
    }

    private function respond(ResponseInterface $response)
    {
        if (! headers_sent()) {

            // Status
            header(sprintf(
                'HTTP/%s %s %s',
                $response->getProtocolVersion(),
                $response->getStatusCode(),
                $response->getReasonPhrase()
            ));

            // Headers
            foreach ($response->getHeaders() as $name => $values) {
                foreach ($values as $value) {
                    header(sprintf('%s: %s', $name, $value), false);
                }
            }
        }

        echo $response->getBody()->getContents();
    }

    public function getNamespace()
    {
        return $this->namespace;
    }
}

require_once __DIR__ . '/../init.php';

<?php

namespace Hector\Core;

use Hector\Core\DependencyInjection\Container;
use Hector\Core\Provider\RoutingServiceProvider;
use Hector\Core\Provider\ServiceProvider;
use Hector\Core\Http\ServerRequest;
use Psr\Http\Message\ResponseInterface;

class Application extends Container
{
	private $isBooted = false;

    private $namespace;
    private $autoloader;

    private $registeredProviders = [];
	private $lazyProviders = [];

    public function __construct(String $namespace)
    {
        $this->namespace = $namespace;

        // Register Hector service providers
	    $this->register(new RoutingServiceProvider());

        // Create the autoloader (...?)
        $this->autoloader = new Autoloader();
        $this->autoloader->addNamespace($this->namespace, $this->namespace . '/');
        $this->autoloader->register();
    }

    public function register(ServiceProvider $provider)
    {
        if($provider->isLazy()) {
        	foreach($provider->provides() as $providing) {
		        $this->lazyProviders[$providing] = $provider;
	        }
        } else {
	        $this->registeredProviders[] = $provider;
	        $this->bootstrapServiceProvider($provider);
        }
    }

    private function bootstrapServiceProvider(ServiceProvider $provider)
    {
	    $provider->register($this);

	    // If the application is already booted, boot the provider right away
	    if($this->isBooted) {
	    	if(method_exists($provider, 'boot')) {
			    $provider->boot($this);
		    }
	    }
    }

    public function get($key)
    {
    	if(isset($this->lazyProviders[$key])) {
		    $this->bootstrapServiceProvider($this->lazyProviders[$key]);
		    unset($this->lazyProviders[$key]);
	    }
	    return parent::get($key);
    }

	public function start()
    {
    	// Boot all service providers
    	$this->boot();

        // Start the session
        \Hector\Core\Session::start($this->namespace);

        // Get the response
        $response = $this->get('router')->route(ServerRequest::fromGlobals());

        // Respond
        $this->respond($response);
    }

    private function boot()
    {
    	// First check if the application is already booted
    	if($this->isBooted) {
    		return;
	    }

	    // Boot all registered providers
    	foreach($this->registeredProviders as $provider) {
    		if(method_exists($provider, 'boot')) {
		        $provider->boot($this);
		    }
	    }

	    $this->isBooted = true;
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

    public function getNamespace() : String
    {
        return $this->namespace;
    }
}

require_once __DIR__ . '/../init.php';

<?php

namespace Hector\Core;

use Hector\Core\Container\Container;
use Hector\Core\Http\Contract\KernelInterface;
use Hector\Core\Http\ServerRequest;
use Hector\Core\Http\ServerRequestServiceProvider;
use Hector\Core\Routing\Contract\RouterInterface;
use Hector\Core\Routing\RoutingServiceProvider;
use Hector\Core\Provider\ServiceProvider;
use Psr\Http\Message\ResponseInterface;

final class Application extends Container
{
    /**
     * Stores if the application is booted
     *
     * @var bool
     */
    private $isBooted = false;

    /**
     * Stores immediately registered service providers
     *
     * @var array
     */
    private $registeredProviders = [];

    /**
     * Stores lazy service providers
     *
     * @var array
     */
    private $lazyProviders = [];

    /**
     * Register a service provider
     *
     * @param ServiceProvider $provider
     * @return void
     */
    public function register(ServiceProvider $provider) : void
    {
        if ($provider->isLazy()) {
            foreach ($provider->provides() as $providing) {
                $this->lazyProviders[$providing] = $provider;
            }
        } else {
            $this->registeredProviders[] = $provider;
            $this->initServiceProvider($provider);
        }
    }

    /**
     * Initialize a service provider
     *
     * @param ServiceProvider $provider
     */
    private function initServiceProvider(ServiceProvider $provider) : void
    {
        $provider->register($this);

        // If the application is already booted, boot the provider right away
        if ($this->isBooted && method_exists($provider, 'boot')) {
            $provider->boot($this);
        }
    }

    /**
     * Get a value by key from the container making sure lazy providers are initialized first
     *
     * @param $key
     * @return mixed
     */
    public function get(string $key)
    {
        if (isset($this->lazyProviders[$key])) {
            $this->initServiceProvider($this->lazyProviders[$key]);
            unset($this->lazyProviders[$key]);
        }
        return parent::get($key);
    }

    /**
     * Boots all non-lazy registered service providers
     *
     * @return void
     */
    private function boot() : void
    {
        // First check if the application is already booted
        if ($this->isBooted) {
            return;
        }

        // Boot all registered providers
        foreach ($this->registeredProviders as $provider) {
            if (method_exists($provider, 'boot')) {
                $provider->boot($this);
            }
        }

        $this->isBooted = true;
    }

    /**
     * Starts the application
     *
     * @return void
     */
    public function start() : void
    {
        // Boot all service providers
        $this->boot();
    }
}
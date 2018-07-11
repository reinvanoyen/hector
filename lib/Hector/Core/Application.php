<?php

namespace Hector\Core;

use Hector\Core\Container\Container;
use Hector\Core\Provider\ServiceProvider;

final class Application extends Container
{
    /**
     * The path to the application
     *
     * @var string
     */
    private $path;

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
     * Application constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Register a service provider
     *
     * @param ServiceProvider|string|array $provider
     * @return void
     */
    public function register($provider): void
    {
        if (is_array($provider)) {
            foreach ($provider as $service) {
                $this->register($service);
            }
            return;
        }

        if (is_string($provider)) {
            $this->set($provider, $provider);
            $provider = $this->get($provider);
        }

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
    private function initServiceProvider(ServiceProvider $provider): void
    {
        $provider->register($this);

        // If the application is already booted, boot the provider right away
        if ($this->isBooted) {
            $this->bootServiceProvider($provider);
        }
    }

    private function bootServiceProvider(ServiceProvider $provider)
    {
        if (! $provider->isBooted()) {
            if (method_exists($provider, 'boot')) {
                $provider->boot($this);
            }

            $provider->setBooted();
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
    private function boot(): void
    {
        // First check if the application is already booted
        if ($this->isBooted) {
            return;
        }

        // Boot all registered providers
        foreach ($this->registeredProviders as $provider) {
            $this->bootServiceProvider($provider);
        }

        $this->isBooted = true;
    }

    /**
     * Bootstrap the application
     *
     * @return void
     */
    public function bootstrap(): void
    {
        // We set this application as the container for the facade
        \Hector\Facade\Facade::setContainer($this);

        // We boot all service providers
        $this->boot();

        if (file_exists($this->path.'/config/providers.php')) {
            $app = $this;
            require_once $this->path.'/config/providers.php';
        }
    }
}
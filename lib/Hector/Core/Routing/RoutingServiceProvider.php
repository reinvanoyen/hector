<?php

namespace Hector\Core\Routing;

use Hector\Core\DependencyInjection\Container;
use Hector\Core\Provider\ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    public function register(Container $app)
    {
        $app->set('router', function () use ($app) {
            return new Router($app);
        });
    }
}

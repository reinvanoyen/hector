<?php

namespace Hector\Core\Routing;

use Hector\Core\Container\Container;
use Hector\Core\Provider\ServiceProvider;
use Hector\Core\Routing\Contract\RouterInterface;

class RoutingServiceProvider extends ServiceProvider
{
    public function register(Container $app)
    {
        $app->set(RouterInterface::class, function () use ($app) {
            return new Router($app);
        });
    }
}
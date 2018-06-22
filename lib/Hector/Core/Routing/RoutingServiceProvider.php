<?php

namespace Hector\Core\Routing;

use Hector\Core\Application;
use Hector\Core\Provider\ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    public function register(Application $app)
    {
        $app->set('router', function () use ($app) {
            return new Router($app);
        });
    }
}

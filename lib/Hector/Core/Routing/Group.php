<?php

namespace Hector\Core\Routing;

use Hector\Core\Application;
use Hector\Core\Http\Middleware\MiddlewareInterface;

class Group
{
    use RouteableTrait;

    public function __construct(Application $app, String $prefix)
    {
        $this->app = $app;
        $this->setPrefix($prefix);
    }

    public function add(MiddlewareInterface $middleware)
    {
        foreach ($this->routes as $method => $routes) {
            foreach ($routes as $route) {
                $route->add($middleware);
            }
        }

        return $this;
    }
}

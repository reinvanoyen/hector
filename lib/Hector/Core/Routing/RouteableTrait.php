<?php

namespace Hector\Core\Routing;

use Hector\Core\Application;

trait RouteableTrait
{
    private $registeringParent = null;
    private $prefix = null;

    private $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
    ];

    public function addRoute(Application $app, $method, $pattern, $action)
    {
        if ($this->registeringParent !== null) {
            $route = $this->registeringParent->addRoute($app, $method, $pattern, $action);
        } else {
            $route = $this->routes[ $method ][] = new Route($app, $pattern, $action);
        }

        $route->setParent(($this->registeringParent ? $this->registeringParent : $this));

        return $route;
    }

    public function getRoutesForMethod($method)
    {
        return $this->routes[ $method ];
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function get(Application $app, $pattern, $action)
    {
        return $this->addRoute($app, 'GET', $pattern, $action);
    }
    public function post(Application $app, $pattern, $action)
    {
        return $this->addRoute($app, 'POST', $pattern, $action);
    }
    public function delete(Application $app, $pattern, $action)
    {
        return $this->addRoute($app, 'DELETE', $pattern, $action);
    }
    public function put(Application $app, $pattern, $action)
    {
        return $this->addRoute($app, 'PUT', $pattern, $action);
    }
}

<?php

namespace Hector\Core\Routing;

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

    public function addRoute($method, $pattern, $action)
    {
        if ($this->registeringParent !== null) {
            $route = $this->registeringParent->addRoute($method, $pattern, $action);
        } else {
            $this->routes[$method][] = $route = new Route($this->app, $pattern, $action);
        }

        $route->setParent(($this->registeringParent ?: $this));

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

    public function get($pattern, $action)
    {
        return $this->addRoute('GET', $pattern, $action);
    }

    public function post($pattern, $action)
    {
        return $this->addRoute('POST', $pattern, $action);
    }

    public function delete($pattern, $action)
    {
        return $this->addRoute('DELETE', $pattern, $action);
    }

    public function put($pattern, $action)
    {
        return $this->addRoute('PUT', $pattern, $action);
    }
}

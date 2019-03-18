<?php

namespace Hector\Core\Routing;

use Hector\Core\Http\Middleware\MiddlewareInterface;

trait RouteableTrait
{
    /**
     * All middleswares
     *
     * @var array
     */
    private $middlewares = [];

    /**
     * This holds all routes for each method
     *
     * @var array
     */
    private $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'PATCH' => [],
        'DELETE' => [],
        'OPTIONS' => [],
    ];

    /**
     * Adds a route
     *
     * @param string $method
     * @param $pattern
     * @param $action
     * @return Route
     */
    private function addRoute(string $method, $pattern, $action)
    {
        $this->routes[$method][] = $route = new Route($this->app, $pattern, $action);

        // Loop through the already added middlewares and add the middleware to the route
        foreach ($this->middlewares as $middleware) {
            $route->add($middleware);
        }

        return $route;
    }

    /**
     * Adds middleware
     *
     * @param MiddlewareInterface $middleware
     * @return $this
     */
    public function add(MiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;

        // Loop through the already added routes and add the middleware
        foreach ($this->routes as $routes) {
            foreach ($routes as $route) {
                $route->add($middleware);
            }
        }

        return $this;
    }

    /**
     * Gets routes for the given method
     *
     * @param $method
     * @return mixed
     */
    public function getRoutesForMethod(string $method)
    {
        return $this->routes[$method];
    }

    /**
     * Registers route on GET method
     *
     * @param $pattern
     * @param $action
     * @return Route
     */
    public function get($pattern, $action)
    {
        return $this->addRoute('GET', $pattern, $action);
    }

    /**
     * Registers route on POST method
     *
     * @param $pattern
     * @param $action
     * @return Route
     */
    public function post($pattern, $action)
    {
        return $this->addRoute('POST', $pattern, $action);
    }

    /**
     * Registers route on PUT method
     *
     * @param $pattern
     * @param $action
     * @return Route
     */
    public function put($pattern, $action)
    {
        return $this->addRoute('PUT', $pattern, $action);
    }

    /**
     * Registers route on PATCH method
     *
     * @param $pattern
     * @param $action
     * @return Route
     */
    public function patch($pattern, $action)
    {
        return $this->addRoute('PATCH', $pattern, $action);
    }

    /**
     * Registers route on DELETE method
     *
     * @param $pattern
     * @param $action
     * @return Route
     */
    public function delete($pattern, $action)
    {
        return $this->addRoute('DELETE', $pattern, $action);
    }

    /**
     * Registers route on OPTIONS method
     *
     * @param $pattern
     * @param $action
     * @return Route
     */
    public function options($pattern, $action)
    {
        return $this->addRoute('OPTIONS', $pattern, $action);
    }

    public function all($pattern, $action)
    {
        $route = $this->get($pattern, $action);
        $this->routes['POST'][] = $route;
        $this->routes['PUT'][] = $route;
        $this->routes['PATCH'][] = $route;
        $this->routes['DELETE'][] = $route;
        $this->routes['OPTIONS'][] = $route;
    }
}

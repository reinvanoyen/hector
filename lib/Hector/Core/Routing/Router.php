<?php

namespace Hector\Core\Routing;

use Hector\Core\Application;
use Hector\Core\Http\Response;
use Psr\Http\Message\ServerRequestInterface;

class Router implements RouterInterface
{
    use RouteableTrait;

    private $groups = [];
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function route(ServerRequestInterface $request)
    {
        $method = $request->getMethod();
        $routes = $this->getRoutesForMethod($method);

        foreach ($this->groups as $group) {
            $routes = array_merge($routes, $group->getRoutesForMethod($method));
        }

        foreach ($routes as $route) {
            if (($matches = $route->match($request)) !== false) {
                try {
                    return $route->execute($request, new Response(200));
                } catch (NotFound $e) {
                    continue;
                }
            }
        }

        return new Response(404);
    }

    public function group(String $prefix, $callable)
    {
        $group = new Group($this->app, $prefix);

        $this->groups[] = $group;

        $this->registeringParent = $group;

        $callable();

        $parent = $this->registeringParent;

        $this->registeringParent = null;

        return $parent;
    }
}

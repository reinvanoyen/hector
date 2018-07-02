<?php

namespace Hector\Core\Routing;

use Hector\Core\DependencyInjection\Container;
use Hector\Core\Http\Response;
use Psr\Http\Message\ServerRequestInterface;

class Router implements RouterInterface
{
    use RouteableTrait;

    /**
     * The application instance
     *
     * @var Container
     */
    private $app;

    /**
     * Router constructor.
     *
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * Route the request
     *
     * @param ServerRequestInterface $request
     * @return Response
     */
    public function route(ServerRequestInterface $request)
    {
        $method = $request->getMethod();
        $routes = $this->getRoutesForMethod($method);

        foreach ($routes as $route) {
            // Check if the route matches
            if (($matches = $route->match($request)) !== false) {
                try {
                    return $route->execute($request, new Response(200));
                } catch (NotFound $e) {
                    continue;
                }
            }
        }

        // No matching route was found
        return new Response(404);
    }
}
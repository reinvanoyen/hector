<?php

namespace Hector\Core\Routing;

use Hector\Contracts\Container\ContainerInterface;
use Hector\Helpers\Http;
use Hector\Helpers\Regex;
use Hector\Helpers\String as Str;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Hector\Core\Http\Middleware\MiddlewareableTrait;

class Route
{
    use MiddlewareableTrait;

    /**
     * The application instance
     *
     * @var Container
     */
    private $app;

    /**
     * @var string
     */
    private $pattern;

    private $action;

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * Route constructor.
     *
     * @param Container $app
     * @param String $pattern
     * @param $action
     */
    public function __construct(ContainerInterface $app, string $pattern, $action)
    {
        $this->app = $app;
        $this->pattern = $pattern;
        $this->action = $action;
    }

    /**
     * Check if the given request matches for this route
     *
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function match(ServerRequestInterface $request)
    {
        $path = Http::getPath($request);

        if (! Regex\namedPregMatch('@^(' . $this->pattern . ')$@', $path, $matches)) {
            return false;
        }

        return ($this->attributes = $matches);
    }

    /**
     * Call the route
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    private function call(ServerRequestInterface $request, ResponseInterface $response)
    {
        $attributes = $this->attributes;

        if (is_callable($this->action)) {

            $callable = $this->action;
            array_unshift($attributes, $request, $response);

        } else if( is_string($this->action) ) {

            $parts = explode('.', $this->action);
            $method = array_pop($parts);
            $controller = implode('\\', $parts);
            $controller = new $controller($this->app, $request, $response);
            $callable = [ $controller, $method ];
        }

        return call_user_func_array($callable, $attributes);
    }

    /**
     * Gets the core function
     *
     * @return \Closure
     */
    private function getCoreFunction()
    {
        return function ($request, $response) {
            $result = $this->call($request, $response);

            if (! ($result instanceof ResponseInterface)) {
                return $response->write($result);
            }

            return $result;
        };
    }

    /**
     * Execute the route with the full middleware stack
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    public function execute(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->runMiddlewareStack($request, $response, $this->getCoreFunction());
    }
}

require_once __DIR__ . '/../../Helpers/Regex.php';
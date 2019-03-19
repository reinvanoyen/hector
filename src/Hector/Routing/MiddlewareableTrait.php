<?php

namespace Hector\Routing;

use Closure;
use Hector\Contracts\Routing\MiddlewareInterface;

trait MiddlewareableTrait
{
    private $middleware = [];

    public function add($middleware)
    {
        if ($middleware instanceof MiddlewareInterface) {
            $this->middleware[] = $middleware;
        } elseif (is_array($middleware)) {
            $this->middleware = array_merge($this->middleware, $middleware);
        } else {
            throw new \UnexpectedValueException('Expected MiddlewareInterface or array');
        }

        return $this;
    }

    private function runMiddlewareStack($request, $response, Closure $core)
    {
        $coreFunction = $this->createCoreFunction($core);

        $middleware = array_reverse($this->middleware);

        $full = array_reduce($middleware, function ($nextMiddleware, $middleware) {
            return $this->createMiddlewareFunction($nextMiddleware, $middleware);
        }, $coreFunction);

        return $full($request, $response);
    }

    private function createMiddlewareFunction($nextMiddleware, $middleware)
    {
        return function ($request, $response) use ($nextMiddleware, $middleware) {
            return call_user_func_array([ $middleware, 'handle'], [ $request, $response, $nextMiddleware ]);
        };
    }

    private function createCoreFunction(Closure $core)
    {
        return function ($request, $response) use ($core) {
            return call_user_func_array($core, [ $request, $response ]);
        };
    }
}

<?php

namespace Hector\Core\Http\Middleware;

use Closure;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BeforeMiddleware implements MiddlewareInterface
{
    public function handle(ServerRequestInterface $request, ResponseInterface $response, Closure $next)
    {
        $response->write('[before]');

        return $next($request, $response);
    }
}

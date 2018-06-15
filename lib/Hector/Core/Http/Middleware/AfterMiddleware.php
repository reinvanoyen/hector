<?php

namespace Hector\Core\Http\Middleware;

use Closure;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AfterMiddleware implements MiddlewareInterface
{
    public function handle(ServerRequestInterface $request, ResponseInterface $response, Closure $next)
    {
        $response = $next($request, $response);

        $response->write('[after]');

        return $response;
    }
}

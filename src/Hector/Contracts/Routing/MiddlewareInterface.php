<?php

namespace Hector\Contracts\Routing;

use Closure;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface MiddlewareInterface
{
    public function handle(ServerRequestInterface $request, ResponseInterface $response, Closure $next);
}

<?php

namespace Hector\Core\Http\Middleware;

use Closure;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface MiddlewareInterface
{
	public function handle( ServerRequestInterface $request, ResponseInterface $response, Closure $next );
}
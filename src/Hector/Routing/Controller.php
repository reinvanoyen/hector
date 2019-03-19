<?php

namespace Hector\Routing;

use Hector\Contracts\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class Controller
{
    protected $app;
    protected $request;
    protected $response;

    public function __construct(ContainerInterface $app, Request $request, Response $response)
    {
        $this->app = $app;
        $this->request = $request;
        $this->response = $response;
    }
}

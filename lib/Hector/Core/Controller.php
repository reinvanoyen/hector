<?php

namespace Hector\Core;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class Controller
{
	protected $app;
	protected $request;
	protected $response;

	public function __construct( Application $app, Request $request, Response $response )
	{
		$this->app = $app;
		$this->request = $request;
		$this->response = $response;
	}
}
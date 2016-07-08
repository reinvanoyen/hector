<?php

namespace Hector\Core;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class Controller
{
	protected $request;
	protected $response;

	public function __construct( Request $request, Response $response )
	{
		$this->request = $request;
		$this->response = $response;
	}
}
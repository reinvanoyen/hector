<?php

namespace Hector\Core;

use Hector\Core\Http\Psr\ServerRequest;
use Hector\Core\Routing\Router;

class App
{
	private $name;

	public function __construct( $name )
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function run()
	{
		Router::reset();

		require_once 'App/' . $this->name . '/Config/main.php';
		require_once 'App/' . $this->name . '/Config/routes.php';

		Router::route( ServerRequest::fromGlobals() );
	}
}
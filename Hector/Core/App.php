<?php

namespace Hector\Core;

use Hector\Core\Runtime;
use Hector\Core\Routing\Router;
use Hector\Core\Http\Request;

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

		require_once 'App/' . $this->name . '/init.php';

		Router::route( new Request() );
	}
}
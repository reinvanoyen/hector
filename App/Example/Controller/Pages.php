<?php

namespace App\Example\Controller;

use Hector\Core\Http\Psr\Request;
use Hector\Core\Http\Psr\Response;
use Hector\Core\Http\Psr\ServerRequest;
use Hector\Core\Http\Psr\Stream;
use Hector\Core\Routing\NotFound;

class Pages extends Base
{
	public function test( $slug, $id )
	{
		throw new NotFound;
	}

	public function view( $slug, $id )
	{
		$response = new Response( 200 );
		$response->write( $slug );

		return $response;
	}
}
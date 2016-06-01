<?php

namespace App\Api\Controller;

use App\ExampleApp\Model\BlogPost;
use Hector\Core\Controller;
use Hector\Core\Http\JSONResponse;
use Hector\Core\Routing\NotFound;
use Hector\Core\Db\FetchException;

class Api extends Controller
{
	public function getIndex()
	{
		$this->request->validate( [
			'id' => 'string',
			'title' => 'string',
		] );

		return new JSONResponse( 'ok' );
	}
}
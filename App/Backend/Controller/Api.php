<?php

namespace App\Backend\Controller;

use App\Backend\Model\BlogPost;
use Hector\Backend\Module;
use Hector\Core\Bootstrap;
use Hector\Core\Controller;
use Hector\Core\Http\InvalidRequestException;
use Hector\Core\Routing\NotFound;
use Hector\Core\Db\FetchException;
use Hector\Core\Http\Response\JSON;

class Api extends Controller
{
	public function getModule()
	{
		try
		{
			$this->request->validate( [
				'id' => 'string',
			] );
		}
		catch( InvalidRequestException $e )
		{
			throw new NotFound();
		}

		$modules = require_once 'App/' . Bootstrap::getCurrentApp()->getName() . '/Config/modules.php';

		$id = $this->request->params->string( 'id' );

		if( isset( $modules[ $id ] ) && $modules[ $id ] instanceof Module )
		{
			$m = $modules[ $id ];
			$m->build();

			return new JSON( $m );
		}
		else
		{
			return new JSON( 'No module found with name ' . $id );
		}
	}
}
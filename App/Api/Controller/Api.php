<?php

namespace App\Api\Controller;

use App\ExampleApp\Model\BlogPost;
use Hector\Core\Controller;
use Hector\Core\Http\InvalidRequestException;
use Hector\Core\Http\JSONResponse;
use Hector\Core\Routing\NotFound;
use Hector\Core\Db\FetchException;

class Api extends Controller
{
	public function getIndex()
	{
		try
		{
			$this->request->validate( [
				'model' => 'string',
			] );
		}
		catch( InvalidRequestException $e )
		{
			throw new NotFound();
		}

		$model = $this->request->params->string( 'model' );

		return new JSONResponse( $model::all() );
	}

	public function save()
	{
		try
		{
			$this->request->validate( [
				'model' => 'string',
				'title' => 'string',
			] );
		}
		catch( InvalidRequestException $e )
		{
			throw new NotFound();
		}

		$model = $this->request->params->string( 'model' );

		$new = new $model( [
			'title' => $this->request->params->string( 'title' ),
		] );

		$new->save();

		return new JSONResponse( [
			'success' => TRUE,
			'result' => $new,
		] );
	}
}
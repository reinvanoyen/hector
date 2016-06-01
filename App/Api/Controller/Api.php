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
		$one = $model::one();

		$one->title = 'oknice';
		$one->save();

		return new JSONResponse( $one );
	}

	public function save()
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

		$new = new $model( [
			'title' => 'ok',
		] );

		$new->save();

		return new JSONResponse( [ 'success' => TRUE, ] );
	}
}
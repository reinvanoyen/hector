<?php

namespace App\Front\Controller;

use App\Front\Model\TestRow;
use Hector\Core\Controller;
use Hector\Core\Db\ConnectionManager;
use Hector\Core\Template;
use Hector\Core\Http\Response;
use Hector\Core\Http\JSONResponse;
use Hector\Core\Http\Redirect;
use Hector\Core\Routing\NotFound;
use Hector\PHPException;
use Hector\Core\Db\QueryBuilder\Query;
use Hector\Core\Db\FetchException;

class Pages extends Controller
{
	public function viewHome()
	{
		try
		{
			return $this->view( TestRow::one()->slug );
		}
		catch( FetchException $e )
		{
			return 'No homepage found';
		}
	}

	public function view( $slug )
	{
		try
		{
			$row = TestRow::load( [ 'slug' => $slug ] );
		}
		catch( FetchException $e )
		{
			throw new NotFound();
		}

		return new JSONResponse( $row );
	}
}

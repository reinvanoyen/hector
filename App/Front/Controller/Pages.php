<?php

namespace App\Front\Controller;

use App\Front\Model\Page;
use App\Front\Model\TestRow;
use Hector\Core\Controller;
use Hector\Core\Db\ConnectionManager;
use Hector\Core\Template;
use Hector\Core\Http\HTTPResponse;
use Hector\Core\Http\JSONResponse;
use Hector\Core\Http\Redirect;
use Hector\Core\Routing\NotFound;
use Hector\PHPException;
use \Hector\Core\Db\QueryBuilder\Query;

class Pages extends Controller
{
	public function view( $id )
	{
		$query = Query::select()->from( 'test_row' )->where( [ 'id' => $id ] );

		return (string) $query;
	}

	public function redirect()
	{
		return new Redirect( 'http://www.google.com' );
	}
}
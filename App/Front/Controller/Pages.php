<?php

namespace App\Front\Controller;

use App\Front\Model\Page;
use App\Front\Model\TestRow;
use Hector\Core\Controller;
use Hector\Core\Template;
use Hector\Core\Http\HTTPResponse;
use Hector\Core\Http\JSONResponse;
use Hector\Core\Http\Redirect;
use Hector\Core\Routing\NotFound;
use Hector\PHPException;

class Pages extends Controller
{
	public function view( $id )
	{
		$testrow = TestRow::load( $id );

		return new JSONResponse( $testrow );
	}

	public function redirect()
	{
		return new Redirect( 'http://www.google.com' );
	}
}
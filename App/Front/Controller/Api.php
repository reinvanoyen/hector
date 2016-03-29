<?php

namespace App\Front\Controller;

use App\Front\Model\Page;
use Hector\Core\Controller;
use Hector\Core\Http\JSONResponse;
use Hector\Core\Routing\NotFound;
use Hector\PHPException;

class Api extends Controller
{
	public function viewPage( $slug )
	{
		try
		{
			$page = Page::load( $slug );
		}
		catch( PHPException $e )
		{
			throw new NotFound();
		}

		return new JSONResponse( $page );
	}
}
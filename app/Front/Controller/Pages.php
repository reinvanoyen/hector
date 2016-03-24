<?php

namespace App\Front\Controller;

use App\Front\Model\Page;
use Hector\Core\Controller;
use Hector\Core\Template;
use Hector\Core\Http\HTTPResponse;
use Hector\Core\Http\JSONResponse;
use Hector\Core\Http\Redirect;
use Hector\PHPException;

class Pages extends Controller
{
	public function viewHome()
	{
		return $this->view( 'home' );
	}

	public function view( $slug )
	{
		try
		{
			$title = Page::getTitleBySlug( $slug );
		}
		catch( PHPException $e )
		{
			throw new \Hector\Core\Routing\NotFound();
		}

		$tpl = new Template();
		$tpl->set( 'page_title', $title );

		return new HTTPResponse( $tpl->render( 'pages/view.php' ) );
	}

	public function redirect()
	{
		return new Redirect( 'http://www.google.com' );
	}
}
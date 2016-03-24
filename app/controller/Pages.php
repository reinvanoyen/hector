<?php

namespace App\Controller;

use Hector\Core\Controller;
use Hector\Core\Template;
use Hector\Core\Http\HTTPResponse;
use Hector\Core\Http\JSONResponse;
use Hector\Core\Http\Redirect;

class Pages extends Controller
{
	public function home()
	{
		$tpl = new Template();
		$tpl->set( 'name', 'Rein' );

		return new HTTPResponse( $tpl->render( 'hello-world.php' ) );
	}

	public function blog()
	{
		$tpl = new Template();
		$tpl->set( 'name', 'Rein' );

		return new HTTPResponse( $tpl->render( 'hello-world.php' ) );
	}

	public function viewAboutUs()
	{
		$tpl = new Template();
		$tpl->set( 'name', 'Ben' );

		return new HTTPResponse( $tpl->render( 'hello-world.php' ) );
	}

	public function json()
	{
		return new JSONResponse( [
			'test' => TRUE,
			'test2' => 'fdfdfd',
		] );
	}

	public function redirect()
	{
		return new Redirect( 'http://www.google.com' );
	}
}
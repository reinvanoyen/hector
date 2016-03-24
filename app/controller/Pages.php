<?php

namespace app\controller;

use
	hector\core\Controller,
	hector\core\Template,
	hector\core\http
;

class Pages extends Controller
{
	public function home()
	{
		$tpl = new Template();
		$tpl->set( 'name', 'Ben' );

		return new http\HTTPResponse( $tpl->render( 'app/templates/hello-world.php' ) );
	}

	public function blog()
	{
		$tpl = new Template();
		$tpl->set( 'name', 'Rein' );

		return new http\HTTPResponse( $tpl->render( 'app/templates/hello-world.php' ) );
	}

	public function viewAboutUs()
	{
		$tpl = new Template();
		$tpl->set( 'name', 'Ben' );

		return new http\HTTPResponse( $tpl->render( 'app/templates/hello-world.php' ) );
	}

	public function json()
	{
		return new http\JSONResponse( [
			'test' => TRUE,
			'test2' => 'fdfdfd',
		] );
	}

	public function redirect()
	{
		return new http\Redirect( 'http://www.tnt.be' );
	}
}
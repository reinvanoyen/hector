<?php

namespace app\controller;

class pages
{
	public static function home( $request )
	{
		$tpl = new \hector\core\Template();
		$tpl->set( 'name', 'Ben' );

		return new \hector\core\http\HttpResponse( $tpl->render( 'app/templates/hello-world.php' ) );
	}

	public static function nogiets( $request )
	{
		$tpl = new \hector\core\Template();
		$tpl->set( 'name', 'Rein' );

		return new \hector\core\http\HttpResponse( $tpl->render( 'app/templates/hello-world.php' ) );
	}

	public static function about_us( $request )
	{
		$tpl = new \hector\core\Template();
		$tpl->set( 'name', 'Ben' );

		return new \hector\core\http\HttpResponse( $tpl->render( 'app/templates/hello-world.php' ) );
	}
}
<?php

namespace app\controller;

class pages
{
	public static function home( $request )
	{
		$tpl = new \hector\core\Template();
		$tpl->set( 'name', 'Ben' );
		$tpl->render( 'hello-world.php' );
	}

	public static function nogiets( $request )
	{
		$tpl = new \hector\core\Template();
		$tpl->set( 'name', 'Rein' );
		$tpl->render( 'hello-world.php' );
	}

	public static function about_us( $request )
	{
		echo 'About us page';
	}
}
<?php

namespace App\Example\Controller;

use Aegis\Template;
use Hector\Core\Routing\NotFound;

class Pages extends Base
{
	public function index( $req, $res )
	{
		$tpl = new Template();
		$tpl->page = 'Index';

		return $tpl->render( 'index' );
	}
}
<?php

namespace App\Example\Controller;

use Hector\Backend\Module;
use Hector\Core\Bootstrap;
use Hector\Core\Controller;

class Pages extends Controller
{
	public function view( $slug )
	{
		$tpl = new \Aegis\Template();
		$tpl->slug = $slug;
		$tpl->render( 'pages/view' );
	}
}
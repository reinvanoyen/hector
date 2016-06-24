<?php

namespace App\Example\Controller;

use Hector\Backend\Module;
use Hector\Core\Bootstrap;
use Hector\Core\Controller;
use Hector\Core\Tpl\Template;

class Pages extends Controller
{
	public function view( $slug )
	{
		$tpl = new Template();
		return $tpl->render( 'pages/view' );
	}
}
<?php

namespace App\Backend\Controller;

use Hector\Backend\Module;
use Hector\Core\Bootstrap;
use Hector\Core\Controller;
use Hector\Core\Tpl\Template;

class Backend extends Controller
{
	public function route()
	{
		$tpl = new Template();
		return $tpl->render( 'index.php' );
	}
}
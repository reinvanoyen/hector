<?php

namespace App\Example\Controller;

use Aegis\Template;
use Hector\Core\Routing\NotFound;

class Pages extends Base
{
	public function index()
	{
		$this->tpl->page = 'Index';

		return $this->tpl->render( 'index' );
	}
}
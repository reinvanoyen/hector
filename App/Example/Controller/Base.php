<?php

namespace App\Example\Controller;

use Aegis\Template;
use Hector\Core\Controller;

class Base extends Controller
{
	protected $tpl;

	public function __construct( $request, $response )
	{
		$this->tpl = new Template();
		$this->tpl->base = $request->getUri();

		parent::__construct( $request, $response );
	}
}
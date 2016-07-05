<?php

namespace App\Example\Controller;

use Hector\Core\Controller;
use Hector\Core\Http\Request;

class Base extends Controller
{
	protected $tpl;

	public function __construct( Request $request )
	{
		$this->tpl = new \Aegis\Template();
		$this->tpl->pages = [ 'Home', 'About us', 'Contact' ];

		parent::__construct( $request );
	}
}
<?php

namespace App\Example\Controller;

use Hector\Core\Controller;
use Psr\Http\Message\ServerRequestInterface;

class Base extends Controller
{
	protected $tpl;

	public function __construct()
	{
		$this->tpl = new \Aegis\Template();
		$this->tpl->pages = [ 'Home', 'About us', 'Contact' ];
	}
}
<?php

namespace Hector\Core;

use Psr\Http\Message\ServerRequestInterface;

abstract class Controller
{
	protected /*Request*/ $request;

	public function __construct( ServerRequestInterface $request )
	{
		$this->request = $request;
	}
	
	public function beforeExecuteRoute(){}
	public function afterExecuteRoute(){}
	public function beforeAction(){}
	public function afterAction(){}
}
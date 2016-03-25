<?php

namespace Hector\Core;

use Hector\Core\Http\Request;

abstract class Controller
{
	protected /*Request*/ $request;

	public function __construct( Request $request )
	{
		$this->request = $request;
	}
}
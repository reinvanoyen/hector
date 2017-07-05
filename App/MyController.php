<?php

namespace app;

use Hector\Core\Http\Response;

class MyController extends \Hector\Core\Controller
{
	public function index( $id )
	{
		return 'Ok';
	}
}
<?php

namespace app\controller;

use
	hector\core\Controller,
	hector\core\Template,
	hector\core\http
;

class Blog extends Controller
{
	public function index()
	{
		return 'blog index';
	}

	public function viewPost( $id )
	{
		return 'blog view post ' . $id;
	}
}
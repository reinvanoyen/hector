<?php

namespace App\Example\Controller;

use Aegis\Template;
use Hector\Core\Controller;

class Users extends Base
{
	public function index()
	{
		return $this->tpl->render( 'users/index' );
	}

	public function login()
	{
		return $this->tpl->render( 'users/login' );
	}

	public function viewProfile( $id, $slug )
	{
		return 'View profile of user with ID ' . $id . ' -> ' . $slug;
	}
}
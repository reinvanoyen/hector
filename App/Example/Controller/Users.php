<?php

namespace App\Example\Controller;

use Aegis\Template;
use Hector\Core\Controller;

class Users extends Controller
{
	public function login( $req, $res )
	{
		$tpl = new Template();
		return $tpl->render( 'users/login' );
	}
}
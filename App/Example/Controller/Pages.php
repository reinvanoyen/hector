<?php

namespace App\Example\Controller;

use Aegis\Template;
use Hector\Core\Routing\NotFound;
use Hector\Form\Form;
use Hector\Form\Input;

class Pages extends Base
{
	public function __construct( $request, $response )
	{
		parent::__construct( $request, $response );

		$this->form = new Form( $this->request );
		$this->form->add( new Input\Text( 'username' ) );
	}

	public function index()
	{
		$this->tpl->page = 'Index';

		return $this->tpl->render( 'index' );
	}

	public function validateLogin()
	{
		if( $this->form->validate() ) {

			return 'ok sweet';
		}

		return 'doesnt work yet';
	}
}

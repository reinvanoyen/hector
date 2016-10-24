<?php

namespace Hector\Form\Input;

use Hector\Form\Form;

abstract class Input
{
	private $form;
	private $name;

	public function __construct( String $name )
	{
		$this->name = $name;
	}

	public function setForm( Form $form )
	{
		$this->form = $form;
	}

	public function validate()
	{
		return true;
	}

	public function getValue()
	{
		var_dump( $this->form->request->getParsedBody() );
		return $this->form->request->getParsedBody();
	}
}

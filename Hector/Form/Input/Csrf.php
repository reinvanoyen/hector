<?php

namespace Hector\Form\Input;

class Csrf extends Input
{
	public function __construct()
	{
		parent::__construct( '__csrf' );
	}
}

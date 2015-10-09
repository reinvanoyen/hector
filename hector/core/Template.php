<?php

namespace hector\core;

class Template
{
	private $data = array();

	public function set( $key, $value )
	{
		$this->data[ $key ] = $value;
	}

	public function render( $template )
	{
		extract( $this->data );
		include 'app/templates/' . $template;
	}
}
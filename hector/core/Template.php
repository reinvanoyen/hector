<?php

namespace Hector\Core;

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

		ob_start();
		include 'App/' . \Hector\Core\Bootstrapper::getCurrentApp()->getName() . '/View/' . $template;
		$output = ob_get_clean();

		return $output;
	}
}
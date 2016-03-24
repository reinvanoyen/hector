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
		include 'App/' . Runtime::getPackage() . '/View/' . $template;
		$output = ob_get_clean();

		return $output;
	}
}
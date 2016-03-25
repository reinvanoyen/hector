<?php

namespace Hector\Core;

use Hector\Core\Bootstrap;

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
		include 'App/' . Bootstrap::getCurrentApp()->getName() . '/View/' . $template;
		$output = ob_get_clean();

		return $output;
	}
}
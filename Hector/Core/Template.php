<?php

namespace Hector\Core;

use Hector\Core\Bootstrap;

class Template
{
	private $data = [];

	public function __set( $k, $v )
	{
		$this->data[ $k ] = $v;
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
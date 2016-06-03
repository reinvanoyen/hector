<?php

namespace Hector\Core\Tpl;

use Hector\Core\Bootstrap;

class Template
{
	public $data = [];

	public function __set( $k, $v )
	{
		$this->data[ $k ] = $v;
	}

	public function render( $filename )
	{
		extract( $this->data );

		include_once( 'App/' . Bootstrap::getCurrentApp()->getName() . '/View/' . $filename );
	}
}
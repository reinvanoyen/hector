<?php

namespace Hector\Core\Tpl\Aegis\Parser\Node;

class StringNode extends Node
{
	private $value;

	public function __construct( $value )
	{
		$this->value = $value;
	}

	public function compile( $compiler )
	{
		$compiler->write( '\'' . $this->value . '\'' );
	}
}

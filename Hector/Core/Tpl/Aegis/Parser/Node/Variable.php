<?php

namespace Hector\Core\Tpl\Aegis\Parser\Node;

class Variable extends Node
{
	private $name;

	public function __construct( $name )
	{
		$this->name = $name;
	}

	public function compile( $compiler )
	{
		$compiler->write( '$this->' . str_replace( '.', '->', $this->name ) );
	}
}

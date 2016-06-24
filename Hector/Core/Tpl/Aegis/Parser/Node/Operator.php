<?php

namespace Hector\Core\Tpl\Aegis\Parser\Node;

class Operator extends Node
{
	private $type;
	
	public function __construct( $type )
	{
		$this->type = $type;
	}

	public function compile( $compiler )
	{
		if( $this->type === '+' )
		{
			$compiler->write( ' . ' );
		}
		else
		{
			$compiler->write( ' ' . $this->type . ' ' );
		}
	}
}

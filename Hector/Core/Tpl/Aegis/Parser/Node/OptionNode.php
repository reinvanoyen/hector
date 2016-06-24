<?php

namespace Hector\Core\Tpl\Aegis\Parser\Node;

class OptionNode extends Node
{
	public $value;

	public function __construct( $value )
	{
		$this->value = $value;
	}

	public function compile( $compiler ) {}
}
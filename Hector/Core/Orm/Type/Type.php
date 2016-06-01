<?php

namespace Hector\Core\Orm\Type;

class Type
{
	public $value;
	protected $options = [];

	public function __construct( $value, $options = [] )
	{
		$this->value = $value;
		$this->options = $options;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setValue( $value )
	{
		$this->value = $value;
	}
}
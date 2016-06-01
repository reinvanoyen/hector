<?php

namespace Hector\Core\Orm\Type;

class Type
{
	private $value;

	public function __construct()
	{
	}

	public function getValue()
	{
		return $value;
	}

	public function setValue( $value )
	{
		$this->value = $value;
	}
}
<?php

namespace Hector\Core\Orm\Type;

class JSON extends Type
{
	public function setValue( $value )
	{
		parent::setValue( $value );
	}

	public function getRawValue()
	{
		$this->value;
	}

	public function getValue()
	{
		return json_decode( $this->value );
	}
}
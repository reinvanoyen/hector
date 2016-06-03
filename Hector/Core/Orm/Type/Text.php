<?php

namespace Hector\Core\Orm\Type;

class Text extends Type
{
	public function setValue( $value )
	{
		parent::setValue( $value );
	}
	
	public function getValue()
	{
		return (string) $this->value;
	}
}
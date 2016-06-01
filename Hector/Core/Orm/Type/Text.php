<?php

namespace Hector\Core\Orm\Type;

class Text extends Type
{
	public function setValue( $value )
	{
		if( isset( $this->options[ 'max_length' ] ) && strlen( $value ) > $this->options[ 'max_length' ] )
		{
			$value = substr( $value, 0, $this->options[ 'max_length' ] );
		}

		parent::setValue( $value );
	}

	public function getValue()
	{
		return (string) $this->value;
	}
}
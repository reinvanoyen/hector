<?php

namespace Hector\Core\Orm\Type;

class Text extends Type
{
	public function setValue( $value )
	{
		// Max length
		if( isset( $this->options[ 'max_length' ] ) && strlen( $value ) > $this->options[ 'max_length' ] )
		{
			$value = substr( $value, 0, $this->options[ 'max_length' ] );
		}

		// Slugify
		if( isset( $this->options[ 'slugify' ] ) && $this->options[ 'slugify' ] )
		{
			$value = \Hector\Helpers\String\slugify( $value );
		}

		parent::setValue( $value );
	}

	public function getValue()
	{
		return (string) $this->value;
	}
}
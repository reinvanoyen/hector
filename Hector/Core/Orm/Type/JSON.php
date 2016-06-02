<?php

namespace Hector\Core\Orm\Type;

class JSON extends Type
{
	public function setValue( $value )
	{
		$value = json_encode( $value );

		parent::setValue( $value );
	}

	public function getValue()
	{
		return json_decode( $this->value );
	}
}
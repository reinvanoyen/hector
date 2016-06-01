<?php

namespace Hector\Core\Orm\Type;

class Text extends Type
{
	public function getValue()
	{
		return $this->value;
	}
}
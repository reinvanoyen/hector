<?php

namespace Hector\Core\Orm\Type;

class Integer extends Type
{
	public function getValue()
	{
		return (int) $this->value;
	}
}
<?php

namespace Hector\Db\Facade;

use Hector\Db\Contract\ConnectionManagerInterface;
use \Hector\Facade\Facade;

class Db extends Facade
{
	protected static function getContract(): string
	{
		return ConnectionManagerInterface::class;
	}
}
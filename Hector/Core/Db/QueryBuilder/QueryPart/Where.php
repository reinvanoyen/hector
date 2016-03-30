<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

class Where extends QueryPart
{
	public function init()
	{
		return $this;
	}

	public function render()
	{
		$part = 'WHERE ';

		return $part;
	}
}
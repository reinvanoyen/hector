<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

class Offset extends QueryPart
{
	private $offset;

	public function init( $offset )
	{
		$this->offset = $offset;
	}

	public function toString()
	{
		return 'OFFSET ' . $this->offset;
	}
}

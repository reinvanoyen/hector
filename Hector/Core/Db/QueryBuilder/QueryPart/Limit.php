<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

class Limit extends QueryPart
{
	private $limit;

	public function init( $limit )
	{
		$this->limit = $limit;
	}

	public function offset( $offset )
	{
		return $this->query->add( 'Offset', [ $offset ] );
	}

	public function toString()
	{
		return 'LIMIT ' . $this->limit;
	}
}

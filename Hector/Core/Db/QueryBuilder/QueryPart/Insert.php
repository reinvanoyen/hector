<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

class Insert extends QueryPart
{
	private $table;

	public function init( $table )
	{
		$this->table = $table;
	}

	public function values( $values = [] )
	{
		return $this->query->add( 'Values', [ $values ] );
	}

	public function toString()
	{
		return 'INSERT INTO ' . $this->quote( $this->table );
	}
}
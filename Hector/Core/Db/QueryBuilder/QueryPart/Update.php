<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

class Update extends QueryPart
{
	private $table;

	public function init( $table )
	{
		$this->table = $table;
	}

	public function set( $values )
	{
		return $this->query->add( 'Set', [ $values ] );
	}

	public function toString()
	{
		return 'UPDATE ' . $this->quote( $this->table );
	}
}

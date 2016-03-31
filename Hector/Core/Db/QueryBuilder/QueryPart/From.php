<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

class From extends QueryPart
{
	private $from;

	public function init( $table )
	{
		$this->from = $table;
	}

	public function where( $values )
	{
		return $this->query->add( 'Where', [ $values ] );
	}

	public function orderBy( $values )
	{
		return $this->query->add( 'OrderBy', [ $values ] );
	}

	public function limit( $limit )
	{
		return $this->query->add( 'Limit', [ $limit ] );
	}

	public function toString()
	{
		return 'FROM ' . $this->quote( $this->from );
	}
}
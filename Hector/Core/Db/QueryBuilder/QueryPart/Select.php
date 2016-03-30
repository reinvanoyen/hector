<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

class Select extends QueryPart
{
	private $columns;

	public function init( $columns )
	{
		$this->columns = $columns;
	}

	public function from( $table )
	{
		return $this->query->add( 'From', [ $table ] );
	}

	public function toString()
	{
		return 'SELECT ' . ( is_array( $this->columns ) ? implode( ',', $this->columns ) : $this->columns );
	}
}

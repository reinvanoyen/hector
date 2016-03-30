<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

class Where extends QueryPart
{
	private $conditions;

	public function init( $conditions )
	{
		$this->conditions = $conditions;
		$this->query->bindValues( $this->conditions );
	}

	public function limit( $limit )
	{
		return $this->query->add( 'Limit', [ $limit ] );
	}

	public function toString()
	{
		$fields = array_keys( $this->conditions );

		array_walk( $fields, function( &$v ) {
			$v = $this->quote( $v ) . ' = ?';
		} );

		return 'WHERE ' . implode( ' AND ', $fields );
	}
}

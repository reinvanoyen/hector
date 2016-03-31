<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

class Set extends QueryPart
{
	private $values;

	public function init( $values )
	{
		$this->values = $values;
		$this->query->bindValues( $this->values );
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
		$fields = array_keys( $this->values );

		array_walk( $fields, function( &$v ) {
			$v = $this->quote( $v ) . ' = ?';
		} );

		return 'SET ' . implode( ', ', $fields );
	}
}

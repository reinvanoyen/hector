<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

class OrderBy extends QueryPart
{
	private $fields;

	public function init( $fields )
	{
		$this->fields = $fields;
	}

	public function limit( $limit )
	{
		return $this->query->add( 'Limit', [ $limit ] );
	}

	public function toString()
	{
		$map = array_map( function( $v, $k ) {

			return $this->quote( $k ) . ' ' . $v;

		}, $this->fields, array_keys( $this->fields ) );

		return 'ORDER BY ' . implode(', ', $map );
	}
}
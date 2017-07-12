<?php

namespace Hector\Core\Db\QueryBuilder;

class Values extends QueryPart
{
	private $values;

	public function __construct($values = [])
	{
		$this->values = $values;
	}

	public function getQueryPart() : String
	{
		$this->getQuery()->addBinding($this->values);

		$columns = implode( ', ', array_keys( $this->values ) );
		$values = implode( ', ', array_fill( 0, count( $this->values ), '?' ) );

		return '(' . $columns . ') VALUES (' . $values . ')';
	}
}
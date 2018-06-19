<?php

namespace Hector\Db\QueryBuilder;

class Set extends QueryPart
{
	private $values;

	const CONNECTS_WITH = [ 'where', 'orderBy', 'limit', ];

	public function __construct($values = [])
	{
		$this->values = $values;
	}

	public function build() : String
	{
		$this->getQuery()->addBinding($this->values);
		return 'SET ' . implode( ' = ?, ', array_keys( $this->values ) ) . ' = ?';
	}
}
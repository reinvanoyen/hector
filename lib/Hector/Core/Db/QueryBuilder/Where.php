<?php

namespace Hector\Core\Db\QueryBuilder;

class Where extends QueryPart
{
	private $conditions = [];

	public function __construct($column, $operator, $value)
	{
		$this->conditions[] = [ $column, $operator, $value, ];
	}

	public function getQueryPart() : String
	{
		return 'WHERE ' . implode( ' AND ', array_map( function( $condition ) {

			if( count($condition) === 3 ) {

				$condition[2] = $this->getQuery()->addBinding($condition[2]);

				return implode( ' ', $condition );
			}

			return $condition[0];

		}, $this->conditions ) );
	}
}
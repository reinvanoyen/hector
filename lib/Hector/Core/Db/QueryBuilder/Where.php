<?php

namespace Hector\Core\Db\QueryBuilder;

class Where extends QueryPart
{
	private $conditions = [];

	public function __construct($column, $operator = null, $value = null)
	{
		if( is_array($column) ) {

			foreach( $column as $index => $value )
			{
				if( is_array( $value ) )
				{
					$count = count($value);

					if( $count > 2 ) {
						$this->conditions[] = $value;
						continue;
					}

					$this->conditions[] = [ $value[0], '=', $value[1], ];
					continue;
				}

				$this->conditions[] = null; // @TODO
			}

		} else if( $operator === null ) {

			$this->conditions[] = [ $column, ];

		} else if( $value === null ) {

			$this->conditions[] = [ $column, '=', $operator, ];

		} else {

			$this->conditions[] = [ $column, $operator, $value, ];
		}
	}

	private function addCondition( $column, $operator, $value )
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
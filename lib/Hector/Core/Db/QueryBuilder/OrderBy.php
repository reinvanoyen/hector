<?php

namespace Hector\Core\Db\QueryBuilder;

class OrderBy extends QueryPart
{
	private $sorters = [];

	const SORT_ASC = 0;
	const SORT_DESC = 1;

	const CONNECTS_WITH = [ 'limit', ];

	public function __construct($column, $sorting = 0)
	{
		if( is_array( $column ) ) {

			foreach( $column as $expression => $sortMethod ) {
				if( is_numeric( $expression ) ) {
					$this->sorters[ $sortMethod ] = $sorting;
				} else {
					$this->sorters[ $expression ] = $sortMethod;
				}
			}

		} else {

			$this->sorters[ $column ] = $sorting;
		}
	}

	public function build() : String
	{
		$output = [];

		foreach( $this->sorters as $expression => $sorting ) {
			$output[] = $expression . ' ' . ( $sorting === self::SORT_ASC ? 'ASC' : 'DESC' );
		}

		return 'ORDER BY ' . implode( ', ', $output );
	}
}
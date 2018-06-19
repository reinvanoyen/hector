<?php

namespace Hector\Db\QueryBuilder;

class Where extends QueryPart
{
	private $queryString;
	private $columns;

	const CONNECTS_WITH = [ 'orderBy', 'limit', ];

	public function __construct($query, $columns = [])
	{
		$this->queryString = $query;
		$this->columns = $columns;
	}

	public function build() : String
	{
		$this->getQuery()->addBinding($this->columns);
		return 'WHERE ' . $this->queryString;
	}
}
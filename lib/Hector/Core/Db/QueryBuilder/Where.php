<?php

namespace Hector\Core\Db\QueryBuilder;

class Where extends QueryPart
{
	private $queryString;
	private $columns;

	const CONNECTS_WITH = [ 'limit', ];

	public function __construct($query, $columns = [])
	{
		$this->queryString = $query;
		$this->columns = $columns;
	}

	public function getQueryPart() : String
	{
		$this->getQuery()->addBinding($this->columns);
		return 'WHERE ' . $this->queryString;
	}
}
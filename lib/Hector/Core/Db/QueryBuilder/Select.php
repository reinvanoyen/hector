<?php

namespace Hector\Core\Db\QueryBuilder;

class Select extends QueryPart
{
	private $columns;
	private $table;

	const CONNECTS_WITH = [ 'where', ];

	public function __construct($columns = [], $table)
	{
		$this->columns = $columns;
		$this->table = $table;
	}

	public function getQueryPart() : String
	{
		return 'SELECT ' . implode( ', ', $this->columns ) . ' FROM `' . $this->table . '`';
	}
}
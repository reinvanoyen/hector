<?php

namespace Hector\Core\Db\QueryBuilder;

class Delete extends QueryPart
{
	private $table;

	const CONNECTS_WITH = [ 'where', ];

	public function __construct($table)
	{
		$this->table = $table;
	}

	public function getQueryPart() : String
	{
		return 'DELETE FROM `' . $this->table . '`';
	}
}
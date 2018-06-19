<?php

namespace Hector\Db\QueryBuilder;

class Insert extends QueryPart
{
	private $table;

	const CONNECTS_WITH = [ 'values', ];

	public function __construct($table)
	{
		$this->table = $table;
	}

	public function build() : String
	{
		return 'INSERT INTO `' . $this->table . '`';
	}
}
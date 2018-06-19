<?php

namespace Hector\Db\QueryBuilder;

class Update extends QueryPart
{
	private $table;

	const CONNECTS_WITH = [ 'set', ];

	public function __construct($table)
	{
		$this->table = $table;
	}

	public function build() : String
	{
		return 'UPDATE `' . $this->table . '`';
	}
}
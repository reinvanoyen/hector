<?php

namespace Hector\Core\Db\QueryBuilder;

class DropTable extends QueryPart
{
	private $table;

	public function __construct($table)
	{
		$this->table = $table;
	}

	public function getQueryPart() : String
	{
		return 'DROP TABLE `' . $this->table . '`';
	}
}
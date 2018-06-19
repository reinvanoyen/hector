<?php

namespace Hector\Db\QueryBuilder;

class DropTable extends QueryPart
{
	private $table;

	public function __construct($table)
	{
		$this->table = $table;
	}

	public function build() : String
	{
		return 'DROP TABLE `' . $this->table . '`';
	}
}
<?php

namespace Hector\Core\Db\QueryBuilder;

class AlterTable extends QueryPart
{
	private $table;

	public function __construct($table)
	{
		$this->table = $table;
	}

	public function build() : String
	{
		return 'ALTER TABLE `' . $this->table . '`';
	}
}
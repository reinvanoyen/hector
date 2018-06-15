<?php

namespace Hector\Core\Db\QueryBuilder;

class CreateTable extends QueryPart
{
	private $table;
	private $columns;

	public function __construct($table, $columns = [])
	{
		$this->table = $table;
		$this->columns = $columns;
	}

	public function build() : String
	{
		$columns = implode( ', ', $this->columns );

		return 'CREATE TABLE `' . $this->table . '`' . ' (' .  $columns . ' )';
	}
}
<?php

namespace Hector\Db\QueryBuilder;

class Limit extends QueryPart
{
	private $rowCount;
	private $offset;

	public function __construct($rowCount, $offset = 0)
	{
		$this->rowCount = $rowCount;
		$this->offset = $offset;
	}

	public function build() : String
	{
		return 'LIMIT ' . $this->rowCount . ( $this->offset !== 0 ? ' OFFSET ' . $this->offset : '' );
	}
}
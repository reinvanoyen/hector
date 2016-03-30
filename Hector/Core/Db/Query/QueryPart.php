<?php

namespace Hector\Core\Db\Query;

class QueryPart
{
	protected $query;
	protected $parameters = [];

	protected /*array*/ $where;

	public function where( $values )
	{
		$this->where = $values;
	}
}
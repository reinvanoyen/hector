<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

class Select extends QueryPart
{
	private $columns;

	public function init()
	{
		$this->columns = func_get_args();
		return $this;
	}

	public function from()
	{
		return $this->query->add( 'From' );
	}

	public function render()
	{
		$part = 'SELECT ';

		if( is_array( $this->columns ) )
		{
			$part .= implode( ',', $this->columns );
		}

		$part .= $this->columns;

		return $part;
	}
}
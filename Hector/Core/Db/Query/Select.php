<?php

namespace Hector\Core\Db\Query;

class Select extends QueryPart
{
	private /*string|Array*/ $columns;
	private /*string*/ $from;

	public function __construct( $columns = '*' )
	{
		$this->columns = $columns;
		return $this;
	}

	public function from( $table )
	{
		$this->from = $table;
		return $this;
	}

	private function getColumnsString()
	{
		if( is_array( $this->columns ) )
		{
			return implode( ',', $this->columns );
		}

		return $this->columns;
	}

	public function __toString()
	{
		return 'SELECT ' . $this->getColumnsString() . ' FROM ' . $this->from;
	}
}
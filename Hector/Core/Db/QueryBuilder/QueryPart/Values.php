<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

class Values extends QueryPart
{
	private $values;

	public function init( $values = [] )
	{
		$this->values = $values;
		$this->query->bindValues( $this->values );
	}

	public function toString()
	{
		return '( ' . join( array_keys( $this->values ), ', ' ) . ' ) VALUES ( ' . rtrim( str_repeat( '?, ', count( $this->values ) ), ', ' ) . ' )';
	}
}
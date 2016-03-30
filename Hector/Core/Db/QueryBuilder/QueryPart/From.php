<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

class From extends QueryPart
{
	private $from;

	public function init()
	{
		return $this;
	}

	public function where()
	{
		return $this->query->add( 'Where' );
	}

	public function render()
	{
		return 'FROM ' . $this->quote( $this->from );
	}
}
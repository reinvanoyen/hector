<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

use Hector\Core\Db\Connection;

abstract class QueryPart
{
	protected $query;

	final public function __construct( $query )
	{
		$this->query = $query;
	}

	protected function quote( $v )
	{
		return '`' . $v . '`';
	}

	public function __toString()
	{
		return $this->query->render();
	}

	public function execute( Connection $connection  )
	{
		$this->query->execute( $connection );
	}

	abstract public function init();
	abstract public function render();
}
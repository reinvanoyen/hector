<?php

namespace Hector\Core\Db\QueryBuilder\QueryPart;

use Hector\Core\Db\Connection;
use Hector\Core\Db\ConnectionManager;

abstract class QueryPart
{
	protected $query;

	final public function __construct( $query, $args = [] )
	{
		$this->query = $query;
		
		call_user_func_array( [ $this, 'init' ], $args );
	}

	final protected function quote( $v )
	{
		return '`' . $v . '`';
	}

	final public function __toString()
	{
		return $this->query->toString();
	}

	final public function setExpectations( array $expectations )
	{
		$this->query->setExpectations( $expectations );
		return $this;
	}

	final public function execute( Connection $connection = NULL )
	{
		if( ! $connection )
		{
			$connection = ConnectionManager::get();
		}

		return $this->query->execute( $connection );
	}

	abstract public function toString();
}

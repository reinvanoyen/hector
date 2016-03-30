<?php

namespace Hector\Core\Db\QueryBuilder;

use Hector\Core\Db\Connection;

abstract class Queryable
{
	const QUOTES = [
		'MySQL' => '`',
	];

	private $bindings = [];

	private /*array*/ $where;

	protected /*string*/ $from;

	protected /*string|Array*/ $columns;

	abstract protected function getName();

	public function execute( Connection $connection )
	{
		$args = $this->bindings;

		array_unshift( $args, (string) $this );

		return call_user_func_array( [ $connection, 'query' ], $args );
	}

	public function where( $values )
	{
		$this->where = $values;

		foreach( $this->where as $field => $value )
		{
			$this->bindValue( $value );
		}

		return $this;
	}

	protected function bindValue( $v )
	{
		$this->bindings[] = $v;
	}

	protected function bindValues( $v )
	{
		// @TODO
	}

	protected function quote( $v )
	{
		$q = Queryable::QUOTES[ 'MySQL' ];
		return $q . $v . $q;
	}

	private function buildQuery()
	{
		$query = $this->getName();

		if( $this->columns )
		{
			$query .= ' ';

			if( is_array( $this->columns ) )
			{
				$query .= implode( ',', $this->columns );
			}
			else
			{
				$query .= $this->columns;
			}
		}

		if( $this->from )
		{
			$query .= ' FROM ' . $this->quote( $this->from );
		}

		if( $this->where )
		{
			$query .= ' WHERE ';
			$i = 0;
			foreach( $this->where as $f => $v )
			{
				$query .= ( $i === 0 ? '' : ' AND ' ) . $this->quote( $f ) . ' = ?';
				$i++;
			}
		}

		return $query;
	}

	public function getQuery()
	{
		return $this->buildQuery();
	}

	public function __toString()
	{
		return $this->getQuery();
	}
}
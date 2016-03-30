<?php

namespace Hector\Core\Db\QueryBuilder;

use Hector\Core\Db\QueryBuilder\QueryPart\QueryPart,
	Hector\Core\Db\QueryBuilder\QueryPart\Select,
	Hector\Core\Db\QueryBuilder\Expectation\UnmetExpectation,
	Hector\Core\Db\Connection
;

class Query
{
	private $parts = [];
	private $bindings = [];
	private $expectations = [];

	const EXPECT_EXACTLY_ONE = 0;
	const EXPECT_MAX_ONE = 1;

	public static function select( $columns = '*' )
	{
		return self::init( 'Select', $columns );
	}

	public static function update( $table )
	{
		return self::init( 'Update', $table );
	}

	private static function init( $part )
	{
		$instance = new static();
		$part = $instance->add( $part, array_slice( func_get_args(), 1 ) );

		return $part;
	}

	public function add( $part, $args = [] )
	{
		$part = 'Hector\\Core\\Db\\QueryBuilder\\QueryPart\\' . $part;
		$part = new $part( $this, $args );
		$this->parts[] = $part;
		return $part;
	}

	public function toString()
	{
		$query = '';

		foreach( $this->parts as $p )
		{
			$query .= $p->toString() . ' ';
		}

		return rtrim( $query, ' ' );
	}

	public function __toString()
	{
		return $this->toString();
	}

	public function bindValue( $v )
	{
		$this->bindings[] = $v;
	}

	public function bindValues( $values )
	{
		$this->bindings = array_merge( $this->bindings, array_values( $values ) );
	}

	public function setExpectations( array $expectations )
	{
		$this->expectations = array_merge( $this->expectations, array_values( $expectations ) );
	}

	public function execute( Connection $connection )
	{
		$result = $connection->query( (string) $this, $this->bindings );
		$count = count( $result );

		foreach( $this->expectations as $e )
		{
			switch( $e )
			{
				case Query::EXPECT_EXACTLY_ONE:
					if( $count !== 1 )
					{
						throw new UnmetExpectation( 'Expected exactly one result, got ' . $count );
					}
			}
		}

		return ( in_array( Query::EXPECT_EXACTLY_ONE, $this->expectations ) ? $result[ 0 ] : $result );
	}
}

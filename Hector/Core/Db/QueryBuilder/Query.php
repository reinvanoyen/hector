<?php

namespace Hector\Core\Db\QueryBuilder;

use Hector\Core\Db\QueryBuilder\QueryPart\QueryPart;
use Hector\Core\Db\QueryBuilder\QueryPart\Select;
use Hector\Core\Db\Connection;

class Query
{
	private $parts = [];
	private $bindings = [];

	public static function select()
	{
		return self::create( 'Select' );
	}

	private static function create( $part )
	{
		$instance = new static();
		$part = $instance->add( $part );

		return $part;
	}

	private function createPart( /*string*/ $part )
	{
		$part = 'Hector\\Core\\Db\\QueryBuilder\\QueryPart\\' . $part;
		$part = new $part( $this );

		$part->init();

		return $part;
	}

	public function add( /*string*/ $part )
	{
		$part = $this->createPart( $part );
		$this->parts[] = $part;
		return $part;
	}

	public function render()
	{
		$query = '';

		foreach( $this->parts as $p )
		{
			$query .= $p->render();
		}

		return $query;
	}

	public function execute( Connection $connection )
	{
		$args = $this->bindings;
		array_unshift( $args, $this->render() );

		return call_user_func_array( [ $connection, 'query' ], $args );
	}
}
<?php

namespace Hector\Core\Db\QueryBuilder;

class Query
{
	private $query = '';
	private $bindings = [];

	private $queryParts = [];

	public static $methodMap = [
		'where' => 'Hector\\Core\\Db\\QueryBuilder\\Where',
	];

	public function addQueryPart( QueryPart $queryPart )
	{
		$queryPart->setQuery( $this );
		$this->queryParts[] = $queryPart;
	}

	public function getQuery()
	{
		$queryParts = array_map( function( $part ) {
			return $part->getQueryPart();
		}, $this->queryParts );

		$this->query = implode( ' ', $queryParts );

		return $this->query;
	}

	public function addBinding($value)
	{
		$this->bindings[] = $value;
		return '?';
	}

	public function getBindings()
	{
		return $this->bindings;
	}

	public static function select( $columns, $table )
	{
		$query = new static();
		$select = new Select( $columns, $table );
		$query->addQueryPart( $select );
		return $select;
	}
}
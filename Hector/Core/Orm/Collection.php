<?php

namespace Hector\Core\Orm;

class Collection implements
	\Iterator,
	\Countable,
	\JsonSerializable
{
	private $rows = [];

	public function __construct( $model, $rows )
	{
		foreach( $rows as $row )
		{
			$this->rows[] = new $model( $row );
		}
	}

	// Iterator
	public function rewind() { reset( $this->rows ); }
	public function current() { return current( $this->rows ); }
	public function key() { return key( $this->rows ); }
	public function next() { next( $this->rows ); }
	public function valid() { return key( $this->rows ) !== NULL; }

	// Countable
	public function count() { return count( $this->rows ); }

	// JsonSerializable
	public function jsonSerialize() { return $this->rows; }
}
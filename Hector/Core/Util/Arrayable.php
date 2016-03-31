<?php

namespace Hector\Core\Util;

class Arrayable implements
	\ArrayAccess,
	\Iterator,
	\Countable,
	\JsonSerializable
{
	private $data;

	public function __construct( $data = [] )
	{
		$this->data = $data;
	}

	// ArrayAccess
	public function offsetExists( $k ) { return isset( $this->data[$k] ); }
	public function offsetGet( $k ) { return $this->data[$k]; }
	public function offsetSet( $k, $v ) { $this->data[$k] = $v; }
	public function offsetUnset( $k ) { unset( $this->data[$k] ); }

	// Iterator
	public function rewind() { reset( $this->data ); }
	public function current() { return current( $this->data ); }
	public function key() { return key( $this->data ); }
	public function next() { next( $this->data ); }
	public function valid() { return key( $this->data ) !== NULL; }

	// Countable
	public function count() { return count( $this->data ); }

	// JsonSerializable
	public function jsonSerialize() { return $this->data; }

	// Magic methods

	public /*boolean*/ function __isset( /*string*/ $k )
	{
		return isset( $this->data[ $k ] );
	}
	
	public /*mixed*/ function __get( /*string*/ $k )
	{
		return ( isset( $this->data[ $k ] ) ? $this->data[ $k ] : NULL );
	}

	public /*mixed*/ function __set( /*string*/ $k, /*mixed*/ $v )
	{
		$this->data[ $k ] = $v;
	}

	final protected function getData() { return $this->data; }
}
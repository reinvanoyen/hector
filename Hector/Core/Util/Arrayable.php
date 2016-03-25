<?php

namespace Hector\Core\Util;

class Arrayable implements
	\ArrayAccess,
	\Iterator,
	\Countable,
	\JsonSerializable
{
	protected $__data;

	public function __construct( $__data = [] )
	{
		$this->__data = $__data;
	}

	// ArrayAccess
	public function offsetExists( $k ) { return isset( $this->__data[$k] ); }
	public function offsetGet( $k ) { return $this->__data[$k]; }
	public function offsetSet( $k, $v ) { $this->__data[$k] = $v; }
	public function offsetUnset( $k ) { unset( $this->__data[$k] ); }

	// Iterator
	public function rewind() { reset( $this->__data ); }
	public function current() { return current( $this->__data ); }
	public function key() { return key( $this->__data ); }
	public function next() { next( $this->__data ); }
	public function valid() { return key( $this->__data ) !== NULL; }

	// Countable
	public function count() { return count( $this->__data ); }

	// JsonSerializable
	public function jsonSerialize() { return $this->__data; }

	// Magic methods
	public /*boolean*/ function __isset( /*string*/ $k ) { return isset( $this->__data[ $k ] ); }
	public /*mixed*/ function __get( /*string*/ $k ) { return ( isset( $this->__data[ $k ] ) ? $this->__data[ $k ] : NULL ); }
	public /*mixed*/ function __set( /*string*/ $k, /*mixed*/ $v ) { $this->__data[ $k ] = $v; }
}
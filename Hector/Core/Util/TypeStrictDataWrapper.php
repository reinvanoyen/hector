<?php

namespace Hector\Core\Util;

class TypeStrictDataWrapper
{
	private /*array*/ $data;

	public function __construct( /*array*/ &$data )
	{
		$this->data = &$data;
	}

	public /*boolean*/ function has( /*mixed*/ $key )
	{
		return isset( $this->data[ $key ] );
	}

	public /*mixed*/ function raw( /*mixed*/ $key, /*mixed*/ $default = '' )
	{
		return isset( $this->data[ $key ] ) ? $this->data[ $key ] : $default;
	}

	public /*string*/ function string( /*mixed*/ $key, /*mixed*/ $default = '' )
	{
		return isset( $this->data[ $key ] ) ? trim( $this->data[ $key ] ) : $default;
	}

	public /*integer*/ function integer( /*mixed*/ $key )
	{
		return isset( $this->data[ $key ] ) ? (int) $this->data[ $key ] : 0;
	}

	public /*mixed*/ function enum( /*mixed*/ $key, /*array*/ $values )
	{
		return isset( $this->data[ $key ] ) && in_array( $this->data[ $key ], $values ) ? $this->data[ $key ] : first( $values );
	}

	public /*mixed*/ function json( /*mixed*/ $key )
	{
		return isset( $this->data[ $key ] ) ? json_decode( $this->data[ $key ], TRUE ) : NULL;
	}
}
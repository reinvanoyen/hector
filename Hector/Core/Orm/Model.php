<?php

namespace Hector\Core\Orm;

use Hector\Core\Bootstrap;

abstract class Model implements \JsonSerializable
{
	const DATADIR = NULL;

	protected /*array*/ $data = [];
	protected /*array*/ $fields = [];

	public function __construct( $data = [] )
	{
		$this->data = $data;
	}

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

	public function jsonSerialize()
	{
		return $this->data;
	}

	public static /*static*/ function create( /*array*/ $data )
	{
		return new static( $data );
	}

	public static function load( $id )
	{
		$data = include 'App/' . Bootstrap::getCurrentApp()->getName() . '/' . static::DATADIR . '/' . $id . '.php';

		return static::create( $data );
	}
}
<?php

namespace Hector\Core\Orm;

use Hector\Core\Util\Arrayable;
use Hector\Core\Bootstrap;

abstract class Model extends Arrayable
{
	const DATADIR = NULL;

	protected /*array*/ $fields = [];

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
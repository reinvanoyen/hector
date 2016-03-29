<?php

namespace Hector\Core\Orm;

use Hector\Core\Util\Arrayable;
use Hector\Core\Bootstrap;
use Hector\Core\Db\ConnectionManager;
use Hector\Core\Db\FetchException;

abstract class Model extends Arrayable
{
	const TABLE = NULL;
	const CONNECTION = NULL;

	protected static /*string*/ $primary_key = 'id';
	protected static /*array*/ $fields = [];

	final public static /*static*/ function create( /*array*/ $data )
	{
		return new static( $data );
	}

	final public static /*static*/ function load( $id )
	{
		return static::create( self::getConnection()->queryRow( 'SELECT * FROM ' . static::TABLE . ' WHERE ' . static::$primary_key . ' = ?', $id ) );
	}

	final public static /*static*/ function loadBy( $fields )
	{
		$query = 'SELECT * FROM ' . static::TABLE;

		$i = 0;
		$params = [];

		foreach( $fields as $f => $v )
		{
			$query .= ( $i === 0 ? ' WHERE ' : ' AND ' ) . $f . ' = ?';
			$params[] = $v;
			$i++;
		}

		array_unshift( $params, $query );

		return static::create( call_user_func_array( [ self::getConnection(), 'queryRow' ], $params ) );
	}

	final public static function all()
	{
		// @TODO
	}

	private static /*Connection*/ function getConnection()
	{
		return ConnectionManager::get( static::CONNECTION );
	}

	private static /*string*/ function getClassName()
	{
		return get_called_class();
	}
}
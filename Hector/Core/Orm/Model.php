<?php

namespace Hector\Core\Orm;

use Hector\Core\Db\QueryBuilder\Query;
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
		return static::create(
			Query::select()
				->from( static::TABLE )
				->where( [ self::$primary_key => $id ] )
				->execute( self::getConnection() )
		);
	}

	final public static /*static*/ function loadBy( $fields )
	{
		return static::create(
			Query::select()
				->from( static::TABLE )
				->where( $fields )
				->execute( self::getConnection() )
		);
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
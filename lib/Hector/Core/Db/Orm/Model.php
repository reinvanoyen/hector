<?php

namespace Hector\Core\Db\Orm;

use Hector\Core\Db\Connection;
use Hector\Core\Db\ConnectionManager;
use Hector\Core\Util\Arrayable;

class Model extends Arrayable
{
	const TABLE = '';
	const CONNECTION = '';

	private static function getConnection() : Connection
	{
		return ConnectionManager::get(static::CONNECTION);
	}

	public static function all($query = '', $values = [])
	{
		$result = self::getConnection()->query( 'SELECT * FROM `' .  static::TABLE . '` ' . $query, $values );

		return new ModelStack( get_called_class(), $result );
	}
}
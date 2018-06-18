<?php

namespace Hector\Core\Db;

class ConnectionManager
{
	private static $connections = [];

	public static function store($name, Connection $connection)
	{
		self::$connections[$name] = $connection;
	}

	public static function get($name)
	{
		if(!isset(self::$connections[$name])) {
			return null;
		}

		return self::$connections[$name];
	}
}
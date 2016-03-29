<?php

namespace Hector\Core\Db;

use Hector\PHPException;

class ConnectionManager
{
	private static $storage = [];

	public static function create( /*string*/ $host, /*string*/ $username, /*string*/ $password, /*string*/ $dbname, /*string*/ $name = '' )
	{
		self::$storage[ $name ] = new Connection( $host, $username, $password, $dbname );
	}

	public static function get( /*string*/ $name = '' )
	{
		return self::$storage[ $name ];
	}
}
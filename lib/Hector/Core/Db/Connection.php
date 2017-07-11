<?php

namespace Hector\Core\Db;

class Connection
{
	private $pdoInstance;

	public function __construct( /*string*/ $host, /*string*/ $username, /*string*/ $password, /*string*/ $dbname )
	{
		$this->pdoInstance = new \PDO( 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8mb4', $username, $password );
		$this->pdoInstance->setAttribute( \PDO::ATTR_EMULATE_PREPARES, false );
	}

	private function createStatement( $query, $bindings = [] )
	{
		$stmt = $this->pdoInstance->prepare( $query );
		$stmt->execute( $bindings );
		return $stmt;
	}

	public function query( $query, $bindings = [] )
	{
		return $this->createStatement( $query, $bindings );
	}
}
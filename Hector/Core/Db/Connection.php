<?php

namespace Hector\Core\Db;

class Connection
{
	private $pdo_instance;

	public function __construct( /*string*/ $host, /*string*/ $username, /*string*/ $password, /*string*/ $dbname )
	{
		$this->pdo_instance = new \PDO( 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8mb4', $username, $password );
	}

	public function query( $query, $bindings = [] )
	{
		$stmt = $this->pdo_instance->prepare( $query );
		$stmt->execute( $bindings );

		$result = $stmt->fetchAll( \PDO::FETCH_ASSOC );

		return $result;
	}
}

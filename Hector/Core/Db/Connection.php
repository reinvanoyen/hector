<?php

namespace Hector\Core\Db;

use Hector\PHPException;

class Connection
{
	private $pdo;

	public function __construct( /*string*/ $host, /*string*/ $username, /*string*/ $password, /*string*/ $dbname )
	{
		$this->pdo = new \PDO( 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8mb4', $username, $password );
	}

	public function prepare( $query )
	{
		$stmt = $this->pdo->prepare( $query );
		$stmt->execute( array_slice( func_get_args(), 1 ) );
		return $stmt;
	}

	public function query( $query )
	{
		$stmt = $this->prepare( $query );
		return $stmt->fetchAll( \PDO::FETCH_ASSOC );
	}

	public function queryRow( $query )
	{
		$stmt = call_user_func_array( [ $this, 'prepare' ], func_get_args() );

		$result = $stmt->fetchAll( \PDO::FETCH_ASSOC );
		$count = count( $result ); // @TODO find better way to count results

		if( $count === 1 )
		{
			return $result[ 0 ];
		}
		else
		{
			throw new FetchException( 'Expected a single row, got ' . $count );
		}
	}
}
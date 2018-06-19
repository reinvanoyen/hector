<?php

namespace Hector\Db\Connector;

abstract class Connector
{
	protected $pdo;

	protected function createPdoConnection(String $dsn, String $host, String $username, String $password, String $dbname ) : \PDO
	{
		$this->pdo = new \PDO($dsn.':host=' . $host . ';dbname=' . $dbname . ';charset=utf8mb4', $username, $password);
		$this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
		return $this->pdo;
	}
}
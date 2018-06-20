<?php

namespace Hector\Db\Connector;

abstract class Connector
{
	protected $pdo;

	protected function createPdoConnection(string $driver, string $host, string $port, string $username, string $password, string $dbname ) : \PDO
	{
		$this->pdo = new \PDO($driver.':host='.$host.';port='.$port.';dbname='.$dbname.';charset=utf8mb4', $username, $password);
		$this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
		return $this->pdo;
	}
}
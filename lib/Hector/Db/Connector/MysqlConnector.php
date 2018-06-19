<?php

namespace Hector\Db\Connector;

class MysqlConnector extends Connector implements ConnectorInterface
{
	private $host;
	private $dbname;
	private $username;
	private $password;

    public function __construct($host, $username, $password, $dbname)
    {
    	$this->host = $host;
    	$this->username = $username;
    	$this->password = $password;
    	$this->dbname = $dbname;
    }

    public function connect() : \PDO
    {
    	return $this->createPdoConnection('mysql', $this->host, $this->username, $this->password, $this->dbname);
    }

    private function createStatement($query, $bindings = [])
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($bindings);
        return $stmt;
    }

    public function query($query, $bindings = [])
    {
        return $this->createStatement($query, $bindings);
    }
}

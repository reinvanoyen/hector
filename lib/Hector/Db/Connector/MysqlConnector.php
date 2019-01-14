<?php

namespace Hector\Db\Connector;

class MysqlConnector extends Connector implements ConnectorInterface
{
    private $host;
    private $port;
    private $dbname;
    private $username;
    private $password;

    public function __construct($host, $port, $username, $password, $dbname)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connect(): \PDO
    {
        return $this->createPdoConnection('mysql', $this->host, $this->port, $this->username, $this->password, $this->dbname);
    }

    private function createStatement(string $query)
    {
        return $this->pdo->prepare($query);
    }

    public function query(string $query)
    {
        return $this->createStatement($query);
    }
}

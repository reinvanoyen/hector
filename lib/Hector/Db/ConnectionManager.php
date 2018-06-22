<?php

namespace Hector\Db;

use Hector\Db\Connector\ConnectorInterface;

class ConnectionManager
{
    private $factory;
    private $connections = [];

    public function __construct(ConnectionFactory $factory)
    {
        $this->factory = $factory;
    }

    public function get($name = '') : ConnectorInterface
    {
        if (!isset($this->connections[$name])) {
            $this->createConnection($name);
        }

        return $this->connections[$name];
    }

    private function createConnection($name)
    {
        $connection = $this->factory->createConnection($name);
        $connection->connect();
        $this->connections[$name] = $connection;
    }
}

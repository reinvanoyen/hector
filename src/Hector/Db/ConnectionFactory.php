<?php

namespace Hector\Db;

use Hector\Config\Contract\ConfigRepositoryInterface;
use Hector\Db\Connector\MysqlConnector;

class ConnectionFactory
{
    private $config;

    public function __construct(ConfigRepositoryInterface $config)
    {
        $this->config = $config;
    }

    public function createConnection() : Connector\ConnectorInterface
    {
        $driver = $this->config->get('DB_DRIVER', 'mysql');
        $host = $this->config->get('DB_HOST', 'localhost');
        $port = $this->config->get('DB_PORT', '3306');
        $username = $this->config->get('DB_USERNAME');
        $password = $this->config->get('DB_PASSWORD');
        $database = $this->config->get('DB_DATABASE');

        if ($driver === 'mysql') {
            return new MysqlConnector($host, $port, $username, $password, $database);
        }
    }
}

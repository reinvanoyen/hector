<?php

namespace Hector\Db;

use Hector\Db\Connector\MysqlConnector;

class ConnectionFactory
{
	private $config;

	public function __construct(array $config)
	{
		$this->config = $config;
	}

	public function createConnection($name) : Connector\ConnectorInterface
	{
		$config = $this->config['db'][$name];

		if($config['dsn'] === 'mysql') {
			return new MysqlConnector($config['host'], $config['username'], $config['password'], $config['dbname']);
		}
	}
}
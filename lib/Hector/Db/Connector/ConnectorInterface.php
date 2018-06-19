<?php

namespace Hector\Db\Connector;

interface ConnectorInterface
{
	public function connect() : \PDO;
}
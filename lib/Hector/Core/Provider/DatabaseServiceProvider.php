<?php

namespace Hector\Core\Provider;

use Hector\Core\Db\Connection;
use Hector\Core\Db\ConnectionManager;

class DatabaseServiceProvider implements \Hector\Core\Provider\ServiceProviderInterface
{
	public function register(\Hector\Core\Application $app)
	{
		$app->set('db', function() use( $app ) {

			$connection = new Connection('localhost', 'root', 'root', 'test');
			ConnectionManager::store('', $connection);
			return $connection;
		});

		$app->get('db');
	}
}
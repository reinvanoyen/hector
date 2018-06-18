<?php

namespace Hector\Core\Provider;

use Hector\Core\Application;
use Hector\Core\Routing\Router;

class RoutingServiceProvider implements ServiceProviderInterface
{
	public function register(Application $app)
	{
		$app->set('Router', function() use ($app) {
			return new Router($app);
		});
	}
}
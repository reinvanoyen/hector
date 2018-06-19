<?php

namespace Hector\Core\Provider;

use Hector\Core\Application;
use Hector\Core\Routing\Router;

class RoutingServiceProvider extends ServiceProvider
{
	public function register(Application $app)
	{
		$app->set('router', function() use ($app) {
			return new Router($app);
		});
	}
}
<?php

namespace Hector\Core\Http;

use Hector\Core\Application;
use Hector\Core\Provider\ServiceProvider;

class ServerRequestServiceProvider extends ServiceProvider
{
	public function register(Application $app)
	{
		$app->set('request', function() {
			return ServerRequest::fromGlobals();
		});
	}
}
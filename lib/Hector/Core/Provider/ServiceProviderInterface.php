<?php

namespace Hector\Core\Provider;

use Hector\Core\Application;

interface ServiceProviderInterface
{
	public function register(Application $app);
}
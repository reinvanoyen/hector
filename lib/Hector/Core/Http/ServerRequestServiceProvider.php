<?php

namespace Hector\Core\Http;

use Hector\Core\Container\Container;
use Hector\Core\Provider\ServiceProvider;

class ServerRequestServiceProvider extends ServiceProvider
{
    public function register(Container $app)
    {
        $app->set('request', function () {
            return ServerRequest::fromGlobals();
        });
    }
}

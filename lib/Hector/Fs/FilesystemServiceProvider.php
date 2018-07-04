<?php

namespace Hector\Fs;

use Hector\Core\DependencyInjection\Container;
use Hector\Core\Provider\ServiceProvider;

class FilesystemServiceProvider extends ServiceProvider
{
    public function register(Container $app)
    {
        $app->factory('fs', function () use ($app) {
            return new LocalFilesystem();
        });
    }
}

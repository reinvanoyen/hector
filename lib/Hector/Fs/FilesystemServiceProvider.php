<?php

namespace Hector\Fs;

use Hector\Core\Application;
use Hector\Core\Provider\ServiceProvider;

class FilesystemServiceProvider extends ServiceProvider
{
    public function register(Application $app)
    {
        $app->factory('fs', function () use ($app) {
            return new LocalFilesystem();
        });
    }
}

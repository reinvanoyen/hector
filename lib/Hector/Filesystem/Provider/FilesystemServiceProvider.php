<?php

namespace Hector\Filesystem\Provider;

use Hector\Contracts\Filesystem\FilesystemInterface;
use Hector\Core\Container\Container;
use Hector\Core\Provider\ServiceProvider;
use Hector\Filesystem\LocalFilesystem;

class FilesystemServiceProvider extends ServiceProvider
{
    public function register(Container $app)
    {
        $app->set(FilesystemInterface::class, LocalFilesystem::class);
    }
}
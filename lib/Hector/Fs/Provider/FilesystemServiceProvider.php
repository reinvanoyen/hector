<?php

namespace Hector\Fs\Provider;

use Hector\Core\Container\Container;
use Hector\Core\Provider\ServiceProvider;
use Hector\Fs\Contract\FilesystemInterface;
use Hector\Fs\LocalFilesystem;

class FilesystemServiceProvider extends ServiceProvider
{
    public function register(Container $app)
    {
        $app->set(FilesystemInterface::class, LocalFilesystem::class);
    }
}
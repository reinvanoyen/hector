<?php

namespace Hector\Fs;

use Hector\Core\Container\Container;
use Hector\Core\Provider\ServiceProvider;
use Hector\Fs\Contract\FilesystemInterface;

class FilesystemServiceProvider extends ServiceProvider
{
    public function register(Container $app)
    {
        $app->set(FilesystemInterface::class, LocalFilesystem::class);
    }
}
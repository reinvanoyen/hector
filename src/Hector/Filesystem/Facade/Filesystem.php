<?php

namespace Hector\Filesystem\Facade;

use Hector\Contracts\Filesystem\FilesystemInterface;
use \Hector\Facade\Facade;

class Filesystem extends Facade
{
    protected static function getContract(): string
    {
        return FilesystemInterface::class;
    }
}

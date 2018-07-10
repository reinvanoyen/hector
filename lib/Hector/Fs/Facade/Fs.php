<?php

namespace Hector\Fs\Facade;

use \Hector\Facade\Facade;
use \Hector\Fs\Contract\FilesystemInterface;

class Fs extends Facade
{
    protected static function getContract(): string
    {
        return FilesystemInterface::class;
    }
}
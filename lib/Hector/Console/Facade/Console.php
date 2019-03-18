<?php

namespace Hector\Console\Facade;

use Hector\Contracts\Console\KernelInterface;
use Hector\Facade\Facade;

class Console extends Facade
{
    protected static function getContract(): string
    {
        return KernelInterface::class;
    }
}
<?php

namespace Hector\Config\Facade;

use Hector\Config\Contract\ConfigRepositoryInterface;
use Hector\Facade\Facade;

class Config extends Facade
{
    protected static function getContract(): string
    {
        return ConfigRepositoryInterface::class;
    }
}
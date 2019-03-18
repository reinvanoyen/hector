<?php

namespace Hector\Config\Facade;

use Hector\Contracts\Config\RepositoryInterface;
use Hector\Facade\Facade;

class Config extends Facade
{
    protected static function getContract(): string
    {
        return RepositoryInterface::class;
    }
}
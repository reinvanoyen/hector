<?php

namespace Hector\Core\Routing\Facade;

use Hector\Core\Routing\Contract\RouterInterface;
use Hector\Facade\Facade;

class Router extends Facade
{
    protected static function getContract(): string
    {
        return RouterInterface::class;
    }
}
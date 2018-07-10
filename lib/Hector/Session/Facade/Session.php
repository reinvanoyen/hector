<?php

namespace Hector\Session\Facade;

use \Hector\Session\Session as _Session;
use \Hector\Facade\Facade;

class Session extends Facade
{
    protected static function getContract(): string
    {
        return _Session::class;
    }
}
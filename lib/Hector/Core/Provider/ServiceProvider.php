<?php

namespace Hector\Core\Provider;

use Hector\Core\Application;

abstract class ServiceProvider
{
    protected $isLazy = false;

    final public function isLazy() : bool
    {
        return $this->isLazy;
    }

    abstract public function register(Application $app);

    public function provides() : array
    {
        return [];
    }
}

<?php

namespace Hector\Core\Provider;

use Hector\Core\DependencyInjection\Container;

abstract class ServiceProvider
{
    protected $isLazy = false;

    final public function isLazy() : bool
    {
        return $this->isLazy;
    }

    abstract public function register(Container $app);

    public function provides() : array
    {
        return [];
    }
}

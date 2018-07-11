<?php

namespace Hector\Core\Provider;

use Hector\Core\Container\Container;

abstract class ServiceProvider
{
    protected $isLazy = false;

    private $booted = false;

    final public function isLazy(): bool
    {
        return $this->isLazy;
    }

    final public function isBooted(): bool
    {
        return $this->booted;
    }

    final public function setBooted()
    {
        $this->booted = true;
    }

    abstract public function register(Container $app);

    public function provides() : array
    {
        return [];
    }
}
<?php

namespace Hector\Core\Provider;

use Hector\Contracts\Container\ContainerInterface;

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

    abstract public function register(ContainerInterface $app);

    public function provides() : array
    {
        return [];
    }
}

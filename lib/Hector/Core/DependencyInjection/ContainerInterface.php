<?php

namespace Hector\Core\DependencyInjection;

interface ContainerInterface
{
    public function get($key);
    public function has($key) : bool;
}

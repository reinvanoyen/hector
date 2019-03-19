<?php

namespace Hector\Contracts\Container;

interface ContainerInterface
{
    public function get(string $contract);
    public function has(string $contract): bool;
}

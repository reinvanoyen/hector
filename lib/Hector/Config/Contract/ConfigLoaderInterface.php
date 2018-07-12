<?php

namespace Hector\Config\Contract;

interface ConfigLoaderInterface
{
    public function load(): array;
}

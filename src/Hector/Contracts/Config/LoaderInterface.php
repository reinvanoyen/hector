<?php

namespace Hector\Contracts\Config;

interface LoaderInterface
{
    public function load(): array;
}

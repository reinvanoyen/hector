<?php

namespace Hector\Console\Command;

class Option
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
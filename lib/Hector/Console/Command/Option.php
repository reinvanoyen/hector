<?php

namespace Hector\Console\Command;

class Option
{
    private $name;

    private $alias;

    public function __construct(string $name, string $alias = '')
    {
        $this->name = $name;
        $this->alias = $alias;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }
}
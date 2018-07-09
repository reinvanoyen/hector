<?php

namespace Hector\Console\Command;

class Option
{
    private $name;

    private $alias;

    /**
     * @var string
     */
    private $description = '';

    public function __construct(string $name, string $alias = '')
    {
        $this->name = $name;
        $this->alias = $alias;
    }

    public static function create(string $name, string $alias = '')
    {
        return new static($name, $alias);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}
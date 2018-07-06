<?php

namespace Hector\Console\Command;

class Argument
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description = '';

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function create(string $name)
    {
        return new static( $name );
    }

    public function getName(): string
    {
        return $this->name;
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
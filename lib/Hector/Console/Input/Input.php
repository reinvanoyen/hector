<?php

namespace Hector\Console\Input;

abstract class Input
{
    /**
     * Holds the given arguments
     *
     * @var array
     */
    private $arguments = [];

    /**
     * Holds the given options
     *
     * @var array
     */
    private $options = [];

    /**
     * Holds the given subcommand
     *
     */
    private $subCommand;

    final public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Gets the argument by index
     *
     * @param int $name
     * @return mixed|null
     */
    final public function getArgument(int $index)
    {
        return $this->arguments[$index] ?? null;
    }

    /**
     * Checks if the argument was given
     *
     * @param int $index
     * @return bool
     */
    final public function hasArgument(int $index): bool
    {
        return isset($this->arguments[$index]);
    }

    final public function setArgument(int $index, $value)
    {
        $this->arguments[$index] = $value;
    }

    final public function getOptions()
    {
        return $this->options;
    }

    final public function getOption(string $name)
    {
        return $this->options[$name] ?? null;
    }

    final public function getSubCommand()
    {
        return $this->subCommand;
    }

    final public function setSubCommand(string $name)
    {
        $this->subCommand = $name;
    }
}
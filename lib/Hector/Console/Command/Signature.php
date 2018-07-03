<?php

namespace Hector\Console\Command;

use Hector\Console\Exception\InvalidArgumentException;
use Hector\Console\Input\Input;

class Signature
{
    /**
     * An array holding the arguments
     *
     * @var array
     */
    private $arguments = [];

    /**
     * An array holding the possible options
     *
     * @var array
     */
    private $options = [];

    /**
     * An array holding the subcommands
     *
     * @var array
     */
    private $subCommands = [];

    /**
     * Add an argument
     *
     * @param Argument $argument
     */
    public function addArgument(Argument $argument)
    {
        $this->arguments[] = $argument;
    }

    /**
     * Add a subcommand
     *
     * @param Command $command
     */
    public function addSubCommand(Command $command)
    {
        $this->subCommands[] = $command;
    }

    /**
     * Add an option
     *
     * @param Option $option
     */
    public function addOption(Option $option)
    {
        $this->options[] = $option;
    }

    /**
     * Check if the given input holds up against this signature
     *
     * @param Input $input
     */
    public function validate(Input $input)
    {
        // Validate arguments first
        foreach ($this->arguments as $argument) {
            if (! $input->hasArgument($argument->getName())) {
                throw new InvalidArgumentException('Missing argument '.$argument->getName());
            }
        }
    }
}
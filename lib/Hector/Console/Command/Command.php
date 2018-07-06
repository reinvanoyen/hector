<?php

namespace Hector\Console\Command;

use Hector\Console\Input\Contract\InputInterface;
use Hector\Console\Output\Contract\OutputInterface;

abstract class Command
{
    /**
     * The signature of the command
     *
     * @var Signature
     */
    private $signature;

    /**
     * Stores if the command was created
     *
     * @var bool
     */
    private $created = false;

    /**
     * Creates the signature of the command
     *
     * @param Signature $signature
     * @return Signature
     */
    abstract public function createSignature(Signature $signature): Signature;

    /**
     * Gets the name of the command
     *
     * @return string
     * @throws \Exception
     */
    final public function getName(): string
    {
        $this->make();

        if (! $this->signature->hasName()) {
            throw new \Exception('Command should have a name');
        }

        return $this->signature->getName();
    }

    /**
     * Gets the description of the command
     *
     * @return string
     * @throws \Exception
     */
    final public function getDescription(): string
    {
        $this->make();

        return $this->signature->getDescription();
    }

    /**
     * Gets the signature of the command
     *
     * @return Signature
     */
    final public function getSignature(): Signature
    {
        $this->make();
        return $this->signature;
    }

    /**
     * Creates the signature of the command
     *
     * @throws \Exception
     */
    final private function make()
    {
        if ($this->created) {
            return;
        }

        $signature = new Signature();
        $signature->addOption(new Option('help', 'h'));
        $this->signature = $this->createSignature($signature);

        if (! $this->signature->hasName()) {
            throw new \Exception('Command should have a name');
        }

        $this->created = true;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->outputHelpMessage($output);
    }

    /**
     * Runs the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    final public function run(InputInterface $input, OutputInterface $output)
    {
        $input->setSignature($this->getSignature());

        $showHelpMessage = (bool) $input->getOption('help');

        if ($showHelpMessage && ! $input->hasSubCommand()) {
            $this->outputHelpMessage($output);
            return;
        }

        if ($input->hasSubCommand()) {

            $command = $this->signature->getSubCommand($input->getSubCommand());
            $command->run($input, $output);
            return;
        }

        $input->validate();

        $this->execute($input, $output);
    }

    /**
     * Output an auto-generated help message
     *
     * @param OutputInterface $output
     */
    public function outputHelpMessage(OutputInterface $output)
    {
        $name = $this->getName();
        $nameLength = strlen($name);

        $output->writeLine(str_repeat('=', $nameLength));
        $output->writeLine(strtoupper($this->getName()));
        $output->writeLine(str_repeat('=', $nameLength));

        // Output the available commands
        $output->writeLine('Available commands:');

        foreach ($this->signature->getSubCommands() as $command) {
            $output->writeLine(str_pad($command->getName(), 20).$command->getDescription());
        }

        // Output the available arguments
        $output->writeLine('Available arguments:');

        foreach ($this->signature->getArguments() as $argument) {
            $output->writeLine(str_pad($argument->getName(), 20).$argument->getDescription());
        }
    }
}
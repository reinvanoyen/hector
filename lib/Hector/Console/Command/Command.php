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

        $this->signature = $this->createSignature(new Signature());

        if (! $this->signature->hasName()) {
            throw new \Exception('Command should have a name');
        }

        $this->created = true;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        throw new \Exception( 'Command needs to override execute method' );
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

        if ($input->hasSubCommand()) {

            $command = $this->signature->getSubCommand($input->getSubCommand());
            $input->reset();
            $command->run($input, $output);
            return;
        }

        $this->execute($input, $output);
    }

    abstract public function createSignature(Signature $signature): Signature;
}
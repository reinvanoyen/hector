<?php

namespace Hector\Console;

use Hector\Console\Command\Command;
use Hector\Console\Command\Signature;
use Hector\Console\Input\Contract\InputInterface;
use Hector\Console\Output\Contract\OutputInterface;

class Kernel extends Command
{
    /**
     * The input handler
     *
     * @var InputInterface
     */
    private $input;

    /**
     * The output handler
     *
     * @var OutputInterface
     */
    private $output;

    /**
     * Kernel constructor.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    public function addCommand(Command $command)
    {
        $this->getSignature()->addSubCommand($command);
    }

    public function start()
    {
        $this->run($this->input, $this->output);
    }

    public function createSignature(Signature $signature): Signature
    {
        return $signature->setName('root');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeLine('Kernel');
    }
}
<?php

namespace Hector\Console;

use Hector\Console\Command\Command;
use Hector\Console\Command\Signature;
use Hector\Console\Input\Contract\InputInterface;
use Hector\Console\Output\Contract\OutputInterface;

class Kernel extends Command
{
    public function addCommand(Command $command)
    {
        $this->getSignature()->addSubCommand($command);
    }

    public function start(InputInterface $input, OutputInterface $output)
    {
        $this->run($input, $output);
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
<?php

namespace Hector\Console;

use Hector\Console\Command\Command;
use Hector\Console\Command\Signature;
use Hector\Console\Contract\KernelInterface;
use Hector\Console\Input\Contract\InputInterface;
use Hector\Console\Output\Contract\OutputInterface;

class Kernel extends Command implements KernelInterface
{
    public function handle(InputInterface $input, OutputInterface $output)
    {
        $this->run($input, $output);
    }

    public function addCommand(Command $command)
    {
        $this->getSignature()->addSubCommand($command);
    }

    protected function createSignature(Signature $signature): Signature
    {
        return $signature->setName('hector');
    }
}
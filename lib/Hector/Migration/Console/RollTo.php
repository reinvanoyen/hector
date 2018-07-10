<?php

namespace Hector\Migration\Console;

use Hector\Console\Command\Argument;
use Hector\Console\Command\Signature;
use Hector\Console\Input\Contract\InputInterface;
use Hector\Console\Output\Contract\OutputInterface;

class RollTo extends MigrateCommand
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('rollto')
            ->setDescription('Rolls to a specific version number')
            ->addArgument(Argument::create('version')->setDescription('The version number to roll to'))
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getMigrator()->rollTo((int) $input->getArgument('version'));
    }
}
<?php

namespace Hector\Migration\Console;

use Hector\Console\Command\Signature;
use Hector\Console\Input\Contract\InputInterface;
use Hector\Console\Output\Contract\OutputInterface;

class Version extends MigrateCommand
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('version')
            ->setDescription('Prints the current version')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeLine($this->getMigrator()->getVersion());
    }
}
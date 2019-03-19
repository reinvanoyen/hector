<?php

namespace Hector\Migration\Console;

use Hector\Console\Command\Signature;
use Hector\Contracts\Console\InputInterface;
use Hector\Contracts\Console\OutputInterface;

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

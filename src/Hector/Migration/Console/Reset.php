<?php

namespace Hector\Migration\Console;

use Hector\Contracts\Console\InputInterface;
use Hector\Contracts\Console\OutputInterface;

use Hector\Console\Command\Signature;

class Reset extends MigrateCommand
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('reset')
            ->setDescription('Undo all revisions')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getMigrator()->reset();
        $output->writeLine('Reset complete', OutputInterface::TYPE_INFO);
    }
}

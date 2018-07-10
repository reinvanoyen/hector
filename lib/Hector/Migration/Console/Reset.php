<?php

namespace Hector\Migration\Console;

use Hector\Console\Command\Signature;
use Hector\Console\Input\Contract\InputInterface;
use Hector\Console\Output\Contract\OutputInterface;

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
    }
}
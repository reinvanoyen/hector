<?php

namespace Hector\Migration\Console;

use Hector\Console\Command\Signature;
use Hector\Console\Input\Contract\InputInterface;
use Hector\Console\Output\Contract\OutputInterface;

class Downdate extends MigrateCommand
{
    public function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('downdate')
            ->setDescription('Downdate to the previous version')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getMigrator()->downdate();
    }
}
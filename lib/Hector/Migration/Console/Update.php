<?php

namespace Hector\Migration\Console;

use Hector\Console\Command\Signature;
use Hector\Console\Input\Contract\InputInterface;
use Hector\Console\Output\Contract\OutputInterface;

class Update extends MigrateCommand
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('update')
            ->setDescription('Update to the next version')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getMigrator()->update();
        $output->writeLine('Update complete', OutputInterface::TYPE_INFO);
    }
}
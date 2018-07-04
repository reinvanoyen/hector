<?php

namespace Hector\Migration;

use Hector\Console\Output\Contract\OutputInterface;
use Hector\Migration\Contract\RevisionInterface;

class ConsoleMigrationLogger implements Contract\MigrationLoggerInterface
{
    private $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public function logUpdate(RevisionInterface $revision)
    {
        $this->output->writeLine($revision->describeUp());
    }

    public function logDowndate(RevisionInterface $revision)
    {
        $this->output->writeLine($revision->describeDown());
    }
}
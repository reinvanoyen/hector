<?php

namespace Hector\Migration\Console;

use Hector\Console\Command\Command;
use Hector\Migration\Migrator;

abstract class MigrateCommand extends Command
{
    private $migrator;

    public function __construct(Migrator $migrator)
    {
        $this->migrator = $migrator;
    }

    protected function getMigrator(): Migrator
    {
        return $this->migrator;
    }
}
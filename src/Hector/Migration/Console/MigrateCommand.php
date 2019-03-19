<?php

namespace Hector\Migration\Console;

use Hector\Console\Command\Command;
use Hector\Migration\Migrator;

abstract class MigrateCommand extends Command
{
    /**
     * @var Migrator
     */
    private $migrator;

    /**
     * MigrateCommand constructor.
     * @param Migrator $migrator
     */
    public function __construct(Migrator $migrator)
    {
        $this->migrator = $migrator;
    }

    /**
     * @return Migrator
     */
    protected function getMigrator(): Migrator
    {
        return $this->migrator;
    }
}

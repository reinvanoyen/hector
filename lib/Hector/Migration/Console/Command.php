<?php

namespace Hector\Migration\Console;

use Hector\Console\Command\Signature;
use Hector\Migration\Migrator;

class Command extends MigrateCommand
{
    private $name;

    public function __construct(string $name, Migrator $migrator)
    {
        $this->name = $name;
        parent::__construct($migrator);
    }

    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName($this->name)
            ->setDescription('Migration CLI tool')
            ->addSubCommand(new Migrate($this->getMigrator()))
            ->addSubCommand(new RollTo($this->getMigrator()))
            ->addSubCommand(new Update($this->getMigrator()))
            ->addSubCommand(new Downdate($this->getMigrator()))
            ->addSubCommand(new Reset($this->getMigrator()))
        ;
    }
}
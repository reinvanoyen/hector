<?php

namespace Hector\Console\Command;

use Hector\Console\Input\Input;

abstract class Command
{
    private $signature;

    final public function make()
    {
        $this->signature = $this->createSignature(new Signature());
    }

    final public function run(Input $input)
    {
        $this->signature->validate($input);
        $this->execute($input);
    }

    abstract public function createSignature(Signature $signature): Signature;
    abstract public function execute(Input $input);
}
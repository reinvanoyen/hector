<?php

namespace Hector\Console\Output;

use Hector\Console\Output\Contract\OutputInterface;

class ConsoleOutput implements OutputInterface
{
    public function writeLine(string $message)
    {
        echo $message . "\n";
    }
}
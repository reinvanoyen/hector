<?php

namespace Hector\Console\Output\Contract;

interface OutputInterface
{
    public function writeLine(string $message);
}
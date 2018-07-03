<?php

namespace Hector\Console\Input;

class ConsoleInput extends Input
{
    public function __construct()
    {
        $argv = $GLOBALS['argv'];
        array_shift($argv);

        foreach ($argv as $key => $value) {
            $this->setArgument($key, $value);
        }
    }
}
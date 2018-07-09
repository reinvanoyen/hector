<?php

namespace Hector\Console\Output;

use Hector\Console\Output\Contract\OutputInterface;

class ConsoleOutput implements OutputInterface
{
    private function formatMessage(string $message, int $type)
    {
        $colors = [
            self::TYPE_PLAIN => '1;37',
            self::TYPE_INFO => '1;34',
            self::TYPE_WARNING => '1;33',
            self::TYPE_ERROR => '0;31',
        ];

        if (! isset($colors[$type])) {
            return $message;
        }

        return "\033[".$colors[$type]."m".$message."\033[0m";
    }

    public function writeLine(string $message, int $type = self::TYPE_PLAIN)
    {
        echo $this->formatMessage($message, $type);
        $this->newline();
    }

    public function write(string $message, int $type = self::TYPE_PLAIN)
    {
        echo $this->formatMessage($message, $type);
    }

    public function newline()
    {
        echo "\n";
    }
}
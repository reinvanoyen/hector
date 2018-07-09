<?php

namespace Hector\Console\Output;

use Hector\Console\Output\Contract\OutputInterface;
use Hector\Fs\Contract\FilesystemInterface;

class FileOutput implements OutputInterface
{
    private $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function writeLine(string $message, int $type = self::TYPE_PLAIN)
    {
        $this->filesystem->append('haha.txt', $message."\n");
    }

    public function write(string $message, int $type = self::TYPE_PLAIN)
    {
        $this->filesystem->append('haha.txt', $message);
    }

    public function newline()
    {
        $this->filesystem->append('haha.txt', "\n");
    }
}
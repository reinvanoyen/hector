<?php

namespace Hector\Log;

use Hector\Fs\Contract\FilesystemInterface;
use Psr\Log\AbstractLogger;

class FileLogger extends AbstractLogger
{
    /**
     * Handles working with files
     *
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * Filename of the file to log to
     *
     * @var string
     */
    private $filename;

    /**
     * FileLogger constructor.
     *
     * @param FilesystemInterface $filesystem
     * @param string $filename
     */
    public function __construct(FilesystemInterface $filesystem, string $filename)
    {
        $this->filesystem = $filesystem;
        $this->filename = $filename;
    }

    /**
     * Gets the current time
     *
     * @return string
     */
    private function getTime(): string
    {
        return date('d/m/Y H:i:s');
    }

    /**
     * Gets PHP's process ID
     *
     * @return int
     */
    private function getProcessId(): int
    {
        return getmypid();
    }

    /**
     * Formats the message
     *
     * @param $level
     * @param string $message
     * @param array $context
     * @return string
     */
    private function formatMessage($level, string $message, array $context = []): string
    {
        return $this->getTime() . ' pid:' . $this->getProcessId() . ' ['.$level.'] '.$message;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        $message = (string) $message;

        $this->filesystem->append($this->filename, $this->formatMessage($level, $message, $context)."\n");
    }
}
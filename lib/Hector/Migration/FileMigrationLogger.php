<?php

namespace Hector\Migration;

use Hector\Fs\Contract\FilesystemInterface;
use Hector\Migration\Contract\RevisionInterface;

class FileMigrationLogger implements Contract\MigrationLoggerInterface
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
     * FileMigrationLogger constructor.
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
     * Log a message
     *
     * @param string $message
     */
    private function log(string $message)
    {
        $this->filesystem->append($this->filename, $message . "\n");
    }

    /**
     * Log the update of the given revision
     *
     * @param RevisionInterface $revision
     */
    public function logUpdate(RevisionInterface $revision)
    {
        $this->log($revision->describeUp());
    }

    /**
     * Log the downdate of a given revision
     *
     * @param RevisionInterface $revision
     */
    public function logDowndate(RevisionInterface $revision)
    {
        $this->log($revision->describeDown());
    }
}

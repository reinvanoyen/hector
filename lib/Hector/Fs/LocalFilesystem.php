<?php

namespace Hector\Fs;

class LocalFilesystem implements Contract\FilesystemInterface
{
    /**
     * Check if the file at path exists
     *
     * @param string $path
     * @return bool
     */
    public function exists(string $path): bool
    {
        return file_exists($path);
    }

    /**
     * Checks if the file at path is writeable
     *
     * @param string $path
     * @return bool
     */
    public function isWriteable(string $path): bool
    {
        return is_writable($path);
    }

    /**
     * Checks if the file at path is readable
     *
     * @param string $path
     * @return bool
     */
    public function isReadable(string $path): bool
    {
        return is_readable($path);
    }

    /**
     * Gets the filesize of the file at path in bytes
     *
     * @param string $path
     * @return int
     */
    public function size(string $path): int
    {
        return filesize($path);
    }

    /**
     * Gets the contents of the file at path
     *
     * @param string $path
     * @return string
     */
    public function get(string $path)
    {
        return file_get_contents($path);
    }

    /**
     * Writes contents to the file at path
     *
     * @param string $path
     * @param $contents
     */
    public function put(string $path, $contents)
    {
        file_put_contents($path, $contents);
    }

    /**
     * Prepends contents to the file at path
     *
     * @param string $path
     * @param $contents
     */
    public function prepend(string $path, $contents)
    {
        if ($this->exists($path)) {
            $this->put($path, $contents.$this->get($path));
            return;
        }

        $this->put($path, $contents);
    }

    /**
     * Append contents to the file at path
     *
     * @param string $path
     * @param $contents
     */
    public function append(string $path, $contents)
    {
        if ($this->exists($path)) {
            $this->put($path, $this->get($path).$contents);
            return;
        }

        $this->put($path, $contents);
    }

    /**
     * Deletes the file at path
     *
     * @param string $path
     */
    public function delete(string $path)
    {
        unlink($path);
    }

    /**
     * Moves the file at path to the new path
     *
     * @param string $path
     * @param string $newPath
     */
    public function move(string $path, string $newPath)
    {
        rename($path, $newPath);
    }
}

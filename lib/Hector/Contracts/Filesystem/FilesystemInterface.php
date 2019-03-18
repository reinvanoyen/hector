<?php

namespace Hector\Contracts\Filesystem;

interface FilesystemInterface
{
    public function exists(string $path): bool;
    public function isWriteable(string $path): bool;
    public function isReadable(string $path): bool;

    public function size(string $path): int;
    public function mimetype(string $path): string;
    public function modificationTime(string $path): int;

    public function get(string $path);
    public function put(string $path, $contents);
    public function prepend(string $path, $contents);
    public function append(string $path, $contents);

    public function files(string $path): array;

    public function delete(string $path);
    public function move(string $path, string $newPath);
}
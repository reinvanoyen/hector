<?php

namespace Hector\Migration\Contract;

interface VersionStorageInterface
{
    public function get(): int;
    public function store(int $version);
}

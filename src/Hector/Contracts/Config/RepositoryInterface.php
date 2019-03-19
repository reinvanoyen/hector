<?php

namespace Hector\Contracts\Config;

interface RepositoryInterface
{
    public function __construct(LoaderInterface $configLoader);
    public function get(string $name, $default = null);
    public function has(string $name) : bool;
    public function set(string $name, $value);
    public function all(): array;
}

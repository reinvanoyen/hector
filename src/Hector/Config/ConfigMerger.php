<?php

namespace Hector\Config;

use Hector\Contracts\Config\LoaderInterface;
use Hector\Contracts\Config\RepositoryInterface;

class ConfigMerger implements LoaderInterface
{
    private $repositories = [];

    public function registerRepository(RepositoryInterface $configRepository)
    {
        $this->repositories[] = $configRepository;
    }

    public function merge(): ConfigRepository
    {
        return new ConfigRepository($this);
    }

    public function load(): array
    {
        $vars = [];

        foreach ($this->repositories as $repository) {
            $vars = array_merge($vars, $repository->all());
        }

        return $vars;
    }
}

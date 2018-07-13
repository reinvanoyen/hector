<?php

namespace Hector\Config;

use Hector\Config\Contract\ConfigLoaderInterface;
use Hector\Config\Contract\ConfigRepositoryInterface;

class ConfigMerger implements ConfigLoaderInterface
{
    private $repositories = [];

    public function registerRepository(ConfigRepositoryInterface $configRepository)
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
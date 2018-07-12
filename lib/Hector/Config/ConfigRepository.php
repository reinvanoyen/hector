<?php

namespace Hector\Config;

use Hector\Config\Contract\ConfigLoaderInterface;
use Hector\Config\Contract\ConfigRepositoryInterface;

class ConfigRepository implements ConfigRepositoryInterface
{
    /**
     * Handles loading the config
     *
     * @var ConfigLoaderInterface
     */
    private $configLoader;

    /**
     * @var array
     */
    private $variables = [];

    /**
     * @var bool
     */
    private $loaded = false;

    /**
     * ConfigRepository constructor.
     * @param ConfigLoaderInterface $configLoader
     */
    public function __construct(ConfigLoaderInterface $configLoader)
    {
        $this->configLoader = $configLoader;
    }

    public function get(string $name, $default = null)
    {
        $this->assureLoaded();

        if (isset($this->variables[$name])) {
            return $this->variables[$name];
        }

        if ($default) {
            return $default;
        }

        throw new \Exception('Config variable with name ' . $name . ' was not found');
    }

    public function has(string $name): bool
    {
        $this->assureLoaded();
        return (isset($this->variables[$name]));
    }

    public function set(string $name, $value)
    {
        $this->assureLoaded();
        $this->variables[$name] = $value;
    }

    public function all(): array
    {
        $this->assureLoaded();
        return $this->variables;
    }

    private function assureLoaded()
    {
        if (! $this->loaded) {
            $this->variables = $this->configLoader->load();
            $this->loaded = true;
        }
    }
}

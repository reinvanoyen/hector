<?php

namespace Hector\Config;

class ConfigRepository implements ConfigRepositoryInterface
{
	private $configLoader;

	public function __construct(ConfigLoaderInterface $configLoader)
	{
		$this->configLoader = $configLoader;
	}

	public function get(string $name, $default = null)
	{
		if (isset($this->configLoader->getVariables()[$name])) {
			return $this->configLoader->getVariables()[$name];
		}

		if ($default) {
			return $default;
		}

		throw new \Exception('Config variable with name ' . $name . ' was not found');
	}

	public function has(string $name): bool
	{
		return (isset($this->configLoader->getVariables()[$name]));
	}

	public function set(string $name, $value)
	{
		$this->configLoader->set($name, $value);
	}

	public function all(): array
	{
		return $this->configLoader->getVariables();
	}
}
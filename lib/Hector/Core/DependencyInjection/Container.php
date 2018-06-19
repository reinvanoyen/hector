<?php

namespace Hector\Core\DependencyInjection;

class Container implements ContainerInterface
{
    private $registry = [];
    private $instances = [];
    private $factoryKeys = [];

	/**
	 * Stores a callable in the container for the given key
	 *
	 * @param String $key
	 * @param callable $factory
	 */
    public function set(String $key, callable $factory)
    {
        $this->registry[$key] = $factory;
    }

	/**
	 * Retreives a value from the container by a given key
	 *
	 * @param $key
	 * @throws \Exception
	 */
    public function get($key)
    {
        if (!$this->has($key)) {
            throw new \Exception('No dependency found with identifier: '.$key);
        }

        if (isset($this->factoryKeys[$key]) && $this->factoryKeys) {
            return $this->create($key, false);
        }

        if (isset($this->instances[$key])) {
            return $this->instances[$key];
        }

        return $this->create($key, true);
    }

	/**
	 * Checks if the container has a value by a given key
	 *
	 * @param $key
	 * @return bool
	 */
    public function has($key) : bool
    {
        return isset($this->registry[$key]);
    }

    public function factory($key, $callable)
    {
        $this->set($key, $callable);
        $this->factoryKeys[$key] = true;
    }

    private function create($key, $keepInstance = true)
    {
        if (!$this->has($key)) {
            throw new \Exception('Could not create dependency with identifier: '.$key);
        }
        $instance = call_user_func($this->registry[$key]);
        if ($keepInstance) {
            $this->instances[$key] = $instance;
        }

        return $instance;
    }
}

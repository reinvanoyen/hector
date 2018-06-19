<?php

namespace Hector\Core\DependencyInjection;

class Container implements ContainerInterface
{
    private $registry = [];
    private $instances = [];
    private $factoryKeys = [];

    public function set($key, $callable)
    {
        $this->registry[$key] = $callable;
    }

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

    public function has($key)
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

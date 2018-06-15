<?php

namespace Hector\Core\DependencyInjection;

class Container implements ContainerInterface
{
    private $registry = [];
    private $instances = [];
    private $factoryIds = [];

    public function set($id, $callable)
    {
        $this->registry[$id] = $callable;
    }

    public function get($id)
    {
        if (!$this->has($id)) {
            throw new \Exception('No dependency found with identifier: '.$id);
        }

        if (isset($this->factoryIds[$id]) && $this->factoryIds) {
            return $this->create($id, false);
        }

        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        return $this->create($id, true);
    }

    public function has($id)
    {
        return isset($this->registry[$id]);
    }

    public function factory($id, $callable)
    {
        $this->set($id, $callable);
        $this->factoryIds[$id] = true;
    }

    private function create($id, $keepInstance = true)
    {
        if (!$this->has($id)) {
            throw new \Exception('Could not create dependency with identifier: '.$id);
        }
        $instance = call_user_func($this->registry[$id]);
        if ($keepInstance) {
            $this->instances[$id] = $instance;
        }

        return $instance;
    }
}

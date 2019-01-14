<?php

namespace Hector\Core\Util;

class Arrayable implements \ArrayAccess, \Iterator, \Countable, \JsonSerializable
{
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    // ArrayAccess
    public function offsetExists($k)
    {
        return isset($this->data[$k]);
    }

    public function offsetGet($k)
    {
        return $this->data[$k];
    }

    public function offsetSet($k, $v)
    {
        $this->data[$k] = $v;
    }

    public function offsetUnset($k)
    {
        unset($this->data[$k]);
    }

    // Iterator
    public function rewind()
    {
        reset($this->data);
    }

    public function current()
    {
        return current($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function next()
    {
        next($this->data);
    }

    public function valid()
    {
        return key($this->data) !== null;
    }

    // Countable
    public function count()
    {
        return count($this->data);
    }

    // JsonSerializable
    public function jsonSerialize()
    {
        return $this->data;
    }

    // Magic methods
    public function __isset($k)
    {
        return isset($this->data[ $k ]);
    }

    public function __get($k)
    {
        return $this->data[$k] ?? null;
    }

    public function __set($k, $v)
    {
        $this->data[ $k ] = $v;
    }

    public function getData()
    {
        return $this->data;
    }
}
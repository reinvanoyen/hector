<?php

namespace Hector\Db\Orm;

class EntityStack implements \Countable, \SeekableIterator
{
    private $manager;
    private $entityClass;
    private $rowData;
    private $entities = [];
    private $count;
    private $index;

    public function __construct(string $manager, string $entityClass, $rowData = [])
    {
        $this->manager = $manager;
        $this->entityClass = $entityClass;
        $this->rowData = $rowData;
    }

    public function count()
    {
        if (! $this->count) {
            $this->count = count($this->rowData);
        }

        return $this->count;
    }

    public function rewind()
    {
        return $this->seek(0);
    }

    public function seek($index)
    {
        $this->index = $index;
    }

    public function next()
    {
        $this->index++;

        if ($this->valid()) {
            return;
        }

        $this->index = -1;
    }

    public function key()
    {
        return $this->valid() ? $this->index : null;
    }

    public function current()
    {
        if (! $this->valid()) {
            return false;
        }

        if (! isset($this->entities[$this->index])) {
            $this->entities[$this->index] = new $this->entityClass($this->manager, $this->rowData[$this->index]);
        }

        return $this->entities[$this->index];
    }

    public function valid()
    {
        return $this->index > -1 && $this->index < $this->count();
    }
}

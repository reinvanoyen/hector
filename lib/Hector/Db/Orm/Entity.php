<?php

namespace Hector\Db\Orm;

use Hector\Core\Util\Arrayable;

class Entity extends Arrayable
{
    private $manager;

    public function __construct(string $manager, array $data = [])
    {
        parent::__construct($data);

        $this->manager = $manager;
    }

    public function save()
    {
        $this->manager::save($this->getData())->execute();
    }
}
<?php

namespace Hector\Core\Db\Orm;

abstract class Relationship
{
    abstract public function load($sourceModel);
}

<?php

namespace Hector\Db\Orm;

abstract class Relationship
{
    abstract public function load($sourceModel);
}

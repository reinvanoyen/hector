<?php

namespace Hector\Core\Db\Orm;

abstract class Relationship
{
	public abstract function load($sourceModel);
}
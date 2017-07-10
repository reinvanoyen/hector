<?php

namespace Hector\Core\Db\Orm;

abstract class Relationship
{
	public abstract function load($primary_key_value);
}
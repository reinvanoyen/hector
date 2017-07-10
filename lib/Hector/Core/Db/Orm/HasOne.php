<?php

namespace Hector\Core\Db\Orm;

class HasOne extends Relationship
{
	private $model;

	public function __construct($model)
	{
		$this->model = $model;
	}

	public function load($primary_key_value)
	{
		return $this->model->load($primary_key_value);
	}
}
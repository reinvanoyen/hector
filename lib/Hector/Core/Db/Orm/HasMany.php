<?php

namespace Hector\Core\Db\Orm;

class HasMany extends Relationship
{
	private $model;
	private $foreignKey;

	public function __construct($model, $foreignKey)
	{
		$this->model = $model;
		$this->foreignKey = $foreignKey;
	}

	public function load($sourceModel)
	{
		return call_user_func( [ $this->model, 'all' ], 'WHERE `' . $this->foreignKey . '` = ?', [ $sourceModel->{ $sourceModel::PRIMARY_KEY } ] );
	}
}
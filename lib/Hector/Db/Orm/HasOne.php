<?php

namespace Hector\Db\Orm;

class HasOne extends Relationship
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function load($sourceModel)
    {
        return call_user_func([ $this->model, 'load' ], $sourceModel->{ $sourceModel::PRIMARY_KEY });
    }
}

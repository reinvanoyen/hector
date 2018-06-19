<?php

namespace Hector\Db\QueryBuilder;

class Query
{
    private $query = '';
    private $bindings = [];

    private $queryParts = [];

    public static $methodMap = [
        'where' => 'Hector\\Db\\QueryBuilder\\Where',
        'limit' => 'Hector\\Db\\QueryBuilder\\Limit',
        'orderBy' => 'Hector\\Db\\QueryBuilder\\OrderBy',
        'values' => 'Hector\\Db\\QueryBuilder\\Values',
        'set' => 'Hector\\Db\\QueryBuilder\\Set',
    ];

    public function addQueryPart(QueryPart $queryPart)
    {
        $queryPart->setQuery($this);
        $this->queryParts[] = $queryPart;
    }

    public function build()
    {
        $queryParts = array_map(function ($part) {
            return $part->build();
        }, $this->queryParts);

        $this->query = implode(' ', $queryParts);

        return $this->query;
    }

    public function addBinding($value)
    {
        if (is_array($value)) {
            foreach ($value as $v) {
                $this->addBinding($v);
            }
            return;
        }
        $this->bindings[] = $value;
    }

    public function getBindings()
    {
        return $this->bindings;
    }

    // Query create functions

    public static function select($columns, $table)
    {
        $query = new static();
        $select = new Select($columns, $table);
        $query->addQueryPart($select);
        return $select;
    }

    public static function delete($table)
    {
        $query = new static();
        $delete = new Delete($table);
        $query->addQueryPart($delete);
        return $delete;
    }

    public static function insert($table)
    {
        $query = new static();
        $insert = new Insert($table);
        $query->addQueryPart($insert);
        return $insert;
    }

    public static function update($table)
    {
        $query = new static();
        $update = new Update($table);
        $query->addQueryPart($update);
        return $update;
    }

    public static function dropTable($table)
    {
        $query = new static();
        $drop = new DropTable($table);
        $query->addQueryPart($drop);
        return $drop;
    }

    public static function createTable($table, $columns = [])
    {
        $query = new static();
        $create = new CreateTable($table, $columns);
        $query->addQueryPart($create);
        return $create;
    }
}

<?php

namespace Hector\Db\QueryBuilder;

class Query
{
    private $bindings = [];
    private $queryParts = [];

    public static $methodMap = [
        'where' => Where::class,
        'limit' => Limit::class,
        'orderBy' => OrderBy::class,
        'values' => Values::class,
        'set' => Set::class,
    ];

    public function build()
    {
        $queryParts = array_map(function ($part) {
            return $part->build();
        }, $this->queryParts);

        return implode(' ', $queryParts);
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

    public function addQueryPart(QueryPart $queryPart)
    {
        $queryPart->setQuery($this);
        $this->queryParts[] = $queryPart;
    }

    private function getLastQueryPart(): QueryPart
    {
        return end($this->queryParts);
    }

    // Automatically try to chain methods

    public function __call($method, $arguments)
    {
        $allowedQueryParts = $this->getLastQueryPart()::CONNECTS_WITH;

        if (in_array($method, $allowedQueryParts)) {
            $queryPartClass = self::$methodMap[$method];
            $queryPart = new $queryPartClass(...$arguments);
            $this->addQueryPart($queryPart);
            return $this;
        }

        throw new \Exception('Can\'t chain method ' . $method . ' to query here');
    }

    // Query create functions

    public static function select($columns, $table)
    {
        $query = new static();
        $select = new Select($columns, $table);
        $query->addQueryPart($select);
        return $select->getQuery();
    }

    public static function delete($table)
    {
        $query = new static();
        $delete = new Delete($table);
        $query->addQueryPart($delete);
        return $delete->getQuery();
    }

    public static function insert($table)
    {
        $query = new static();
        $insert = new Insert($table);
        $query->addQueryPart($insert);
        return $insert->getQuery();
    }

    public static function update($table)
    {
        $query = new static();
        $update = new Update($table);
        $query->addQueryPart($update);
        return $update->getQuery();
    }

    public static function dropTable($table)
    {
        $query = new static();
        $drop = new DropTable($table);
        $query->addQueryPart($drop);
        return $drop->getQuery();
    }

    public static function createTable($table, $columns = [])
    {
        $query = new static();
        $create = new CreateTable($table, $columns);
        $query->addQueryPart($create);
        return $create->getQuery();
    }
}

<?php

namespace Hector\Db\QueryBuilder;

abstract class QueryPart
{
    const CONNECTS_WITH = [];

    private $query;

    abstract public function build() : String;

    public function setQuery(Query $query)
    {
        $this->query = $query;
    }

    public function getQuery() : Query
    {
        return $this->query;
    }

    public function __call($method, $arguments)
    {
        if (isset(Query::$methodMap[ $method ]) && in_array($method, static::CONNECTS_WITH)) {
            $queryPart = new Query::$methodMap[ $method ](...$arguments);
            $this->query->addQueryPart($queryPart);
            return $queryPart;
        }
    }
}

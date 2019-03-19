<?php

namespace Hector\Db\QueryBuilder;

abstract class QueryPart
{
    const CONNECTS_WITH = [];

    private $query;

    abstract public function build(): string ;

    public function setQuery(Query $query)
    {
        $this->query = $query;
    }

    public function getQuery(): Query
    {
        return $this->query;
    }
}

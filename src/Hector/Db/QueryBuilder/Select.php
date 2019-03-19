<?php

namespace Hector\Db\QueryBuilder;

class Select extends QueryPart
{
    private $columns;
    private $table;

    const CONNECTS_WITH = [ 'where', 'orderBy', 'limit', ];

    public function __construct($columns, $table)
    {
        $this->columns = $columns;
        $this->table = $table;
    }

    public function build(): string
    {
        return 'SELECT ' . implode(', ', $this->columns) . ' FROM `' . $this->table . '`';
    }
}

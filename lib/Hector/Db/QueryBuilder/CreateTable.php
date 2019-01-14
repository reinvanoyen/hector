<?php

namespace Hector\Db\QueryBuilder;

class CreateTable extends QueryPart
{
    private $table;
    private $columns;

    public function __construct($table, $columns = [])
    {
        $this->table = $table;
        $this->columns = $columns;
    }

    public function build() : String
    {
        $explodedCols = implode(', ', $this->columns);

        return 'CREATE TABLE `' . $this->table . '`' . (count($this->columns) ? ' ('.$explodedCols.' )' : '');
    }
}

<?php

namespace Hector\Db\Orm;

use Hector\Db\ConnectionManager;
use Hector\Db\QueryBuilder\Query;

class Manager extends Query
{
    const PRIMARY_KEY = 'id';
    const TABLE = '';
    const CONNECTION = '';
    const ENTITY = '';

    protected static $db;

    public static function setDb(ConnectionManager $db)
    {
        self::$db = $db;
    }

    private static function getDb()
    {
        return self::$db->get(static::CONNECTION);
    }

    private function getStatement()
    {
        return self::getDb()->query($this->build());
    }

    // Entry points to create model-specific queries

    public static function all(): Manager
    {
        return self::select(['*'], static::TABLE);
    }

    public static function load(int $primaryKeyValue): Manager
    {
        return self::select(['*'], static::TABLE)
            ->where(static::PRIMARY_KEY.' = ?', $primaryKeyValue)
        ;
    }

    public static function loadBy($field, $value): Manager
    {
        return self::select(['*'], static::TABLE)
            ->where($field.' = ?', $value)
        ;
    }

    public static function save($values = []): Manager
    {
        if (isset($values[static::PRIMARY_KEY])) {

            return self::update(static::TABLE)
                ->set($values)
                ->where(static::PRIMARY_KEY.' = ?', $values[static::PRIMARY_KEY])
            ;
        }

        return self::insert(static::TABLE)
            ->values($values)
        ;
    }

    public static function create($data = []): Entity
    {
        $entityClass = static::ENTITY;
        return new $entityClass(get_called_class(), $data);
    }

    // Execute methods

    public function execute()
    {
        return $this->getStatement()->execute($this->getBindings());
    }

    public function getAll(): EntityStack
    {
        $entityClass = static::ENTITY;

        $statement = $this->getStatement();
        $statement->execute($this->getBindings());

        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return new EntityStack(
            get_called_class(),
            $entityClass,
            $result
        );
    }

    public function getOne(): Entity
    {
        $entityClass = static::ENTITY;

        $statement = $this->getStatement();
        $statement->execute($this->getBindings());

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return new $entityClass(get_called_class(), $result);
    }
}
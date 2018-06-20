<?php

namespace Hector\Db\Orm;

use Hector\Db\Connection;
use Hector\Db\ConnectionManager;
use Hector\Db\Connector\ConnectorInterface;
use Hector\Db\QueryBuilder\Query;
use Hector\Core\Util\Arrayable;

class Model extends Arrayable
{
	const PRIMARY_KEY = 'id';
	const TABLE = '';
	const CONNECTION = '';

	protected $relationCache = [];

	protected static $connectionManager;

	public function __get($property)
	{
		if( isset( $this->relationCache[ $property ] ) ) {

			return $this->relationCache[ $property ];

		} else if( method_exists($this, $property) ) {

			$relation = $this->{ $property }();
			$this->relationCache[ $property ] = $relation->load( $this );

			return $this->relationCache[ $property ];
		}

		return parent::__get($property);
	}

	public static function all($query = '', $values = [])
	{
		$stmt = self::getConnection()->query(' SELECT * FROM `' .  static::TABLE . '` ' . $query, $values );
		return new ModelStack(get_called_class(), $stmt->fetchAll(\PDO::FETCH_ASSOC));
	}

	public static function load($primary_key_value)
	{
		$query = Query::select( [ '*' ], static::TABLE )
			->where( '`' . static::PRIMARY_KEY . '` = ?', $primary_key_value )
		;

		$stmt = self::getConnection()->query( $query->getQuery()->build(), $query->getQuery()->getBindings() );
		return new static( $stmt->fetch( \PDO::FETCH_ASSOC ) );
	}

	public static function loadBy($field, $value)
	{
		$query = Query::select( [ '*' ], static::TABLE )
			->where( '`' . $field . '` = ?', $value )
		;

		$stmt = self::getConnection()->query( $query->getQuery()->build(), $query->getQuery()->getBindings() );
		return new static( $stmt->fetch( \PDO::FETCH_ASSOC ) );
	}

	public function save()
	{
		if( $this->{ static::PRIMARY_KEY } ) {

			$query = Query::update( static::TABLE )
				->set( $this->toArray() )
				->where( '`' . static::PRIMARY_KEY . '` = ?', $this->{ static::PRIMARY_KEY } )
			;

		} else {

			$query = Query::insert( static::TABLE )
				->values( $this->toArray() )
			;
		}

		self::getConnection()->query($query->getQuery()->build(), $query->getQuery()->getBindings());
	}

	public function delete()
	{
		$query = Query::delete( static::TABLE )
			->where( static::PRIMARY_KEY . ' = ?', $this->{ static::PRIMARY_KEY } )
		;

		self::getConnection()->query( $query->getQuery()->build(), $query->getQuery()->getBindings() );
	}

	private static function getConnection() : ConnectorInterface
	{
		return static::$connectionManager->get(static::CONNECTION);
	}

	// relations
	protected function hasOne($model)
	{
		return new HasOne($model);
	}

	protected function hasMany($model)
	{
		return new HasMany($model, static::TABLE);
	}

	public static function setConnectionManager(ConnectionManager $manager)
	{
		static::$connectionManager = $manager;
	}
}
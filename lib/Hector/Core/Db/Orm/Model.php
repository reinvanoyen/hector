<?php

namespace Hector\Core\Db\Orm;

use Hector\Core\Db\Connection;
use Hector\Core\Db\ConnectionManager;
use Hector\Core\Util\Arrayable;

class Model extends Arrayable
{
	const PRIMARY_KEY = 'id';
	const TABLE = '';
	const CONNECTION = '';

	protected static $aliases = [];

	public function __get($property)
	{
		if( isset( static::$aliases[ $property ] ) )
		{

		}

		/*
			if( method_exists($this, $property) ) {
				return $this->{$property}($this->{$property});
			}
		*/
		return parent::__get($property);
	}

	public static function all($query = '', $values = [])
	{
		$stmt = self::getConnection()->query( 'SELECT * FROM `' .  static::TABLE . '` ' . $query, $values );
		return new ModelStack( get_called_class(), $stmt->fetchAll( \PDO::FETCH_ASSOC ) );
	}

	public static function load($primary_key_value)
	{
		$stmt = self::getConnection()->query( 'SELECT * FROM `' . static::TABLE . '` WHERE `' . static::PRIMARY_KEY . '` = ?', [ $primary_key_value, ] );
		return new static( $stmt->fetch( \PDO::FETCH_ASSOC ) );
	}

	public function save()
	{
		$data = $this->toArray();

		$fields = array_keys($data);
		$values = array_values($data);

		if( $this->{ static::PRIMARY_KEY } ) {

			$query = 'UPDATE `' . static::TABLE . '` SET `' . implode( '` = ?, `', $fields ) . '` = ? WHERE `' . static::PRIMARY_KEY . '` = ?';
			$values[] = $this->{ static::PRIMARY_KEY };

		} else {

			$query = 'INSERT INTO `' . static::TABLE . '` (' . implode( ', ', $fields ) . ') VALUES (' . str_repeat( '? ,', count( $fields ) - 1 ) . ' ? )';
		}

		self::getConnection()->query($query, $values);
	}

	public function delete()
	{
		self::getConnection()->query('DELETE FROM `'.static::TABLE.'` WHERE id = ?', [ $this->{ static::PRIMARY_KEY } ]);
	}

	private static function getConnection() : Connection
	{
		return ConnectionManager::get(static::CONNECTION);
	}
}
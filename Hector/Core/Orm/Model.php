<?php

namespace Hector\Core\Orm;

use Hector\Core\Util\Arrayable;
use Hector\Core\Db\ConnectionManager;
use Hector\Core\Db\QueryBuilder\Query;

abstract class Model extends Arrayable
{
	const TABLE = NULL;
	const CONNECTION = NULL;

	const TYPE_TEXT = 'Hector\\Core\\Orm\\Type\\Text';

	protected static /*string*/ $primary_key = 'id';
	protected static /*string*/ $fields = [];

	public function __construct( $data )
	{
		$fields = [];

		foreach( static::$fields as $name => $definition )
		{
			$type = $definition[ 0 ];
			$opts = $definition[ 1 ];

			$fields[ $name ] = new $type( $data[ $name ], $opts );
		}

		parent::__construct( $fields );
	}

	final public static /*static*/ function create( /*array*/ $data )
	{
		return new static( $data );
	}

	final public static /*static*/ function load( $values )
	{
		if( ! is_array( $values ) )
		{
			$values = [ static::$primary_key => $values ];
		}

		return static::create(
			Query::select()
				->from( static::TABLE )
				->where( $values )
				->setExpectations( [
					Query::EXPECT_EXACTLY_ONE,
				] )
				->execute( self::getConnection() )
		);
	}

	public function save()
	{
		Query::update( static::TABLE )
			->set( $this->getData() )
			->where( [ static::$primary_key => $this[ static::$primary_key ] ] )
			->execute( self::getConnection() )
		;
	}

	final public static function all()
	{
		return new Collection(
			get_called_class(),
			Query::select()
				->from( static::TABLE )
				->execute( self::getConnection() )
		);
	}

	final public static function one()
	{
		return static::create( Query::select()
				->from( static::TABLE )
				->limit( 1 )
				->setExpectations( [
					Query::EXPECT_EXACTLY_ONE,
				] )
				->execute( self::getConnection() )
		);
	}

	private static /*Connection*/ function getConnection()
	{
		return ConnectionManager::get( static::CONNECTION );
	}

	public function jsonSerialize()
	{
		$fields = [];

		foreach( $this as $field => $value )
		{
			$fields[ $field ] = $value->getValue();
		}

		return $fields;
	}
}
<?php

namespace Hector\Core\Orm;

use Hector\Core\Util\Arrayable;
use Hector\Core\Db\ConnectionManager;
use Hector\Core\Db\QueryBuilder\Query;

abstract class Model extends Arrayable
{
	const TABLE = NULL;
	const CONNECTION = NULL;

	protected static /*string*/ $primary_key = 'id';
	protected static /*string*/ $fields = [];

	const TYPE_TEXT = 'Hector\\Core\\Orm\\Type\\Text';
	const TYPE_INT = 'Hector\\Core\\Orm\\Type\\Integer';

	public function __construct( $data )
	{
		$fields = [];
// @TODO fix this mess
		foreach( static::$fields as $k => $definition )
		{
			$val = ( isset( $data[ $k ] ) ? $data[ $k ] : NULL );
			$this->createField( $k );
			$this[ $k ]->setValue( $val );
		}

		parent::__construct( $fields );
	}

	final public static /*static*/ function create( /*array*/ $data )
	{
		return new static( $data );
	}

	final private function createField( $k )
	{
		if( !isset( $this[ $k ] ) && isset( static::$fields[ $k ] ) )
		{
			$definition = static::$fields[ $k ];

			$type = ( is_array( $definition ) ? $definition[ 0 ] : $definition );
			$opts = ( is_array( $definition ) ? $definition[ 1 ] : [] );

			$this[ $k ] = new $type( $this, NULL, $opts );
		}
	}

	final public function __set( $k, $v )
	{
		$this->createField( $k );
		$this[ $k ]->setValue( $v );
	}

	final public function __get( $k )
	{
		$this->createField( $k );
		return $this[ $k ]->getValue();
	}

	final protected function getData()
	{
		$data = [];

		foreach( $this as $field => $value )
		{
			$data[ $field ] = $value->getValue();
		}

		return $data;
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
				->setExpectations( [ Query::EXPECT_EXACTLY_ONE, ] )
				->execute( self::getConnection() )
		);
	}

	public function save()
	{
		if( isset( $this[ static::$primary_key ] ) )
		{
			Query::update( static::TABLE )
				->set( $this->getData() )
				->where( [ static::$primary_key => $this[ static::$primary_key ]->getValue() ] )
				->execute( self::getConnection(), TRUE )
			;
		}
		else
		{
			Query::insert( static::TABLE )
				->values( $this->getData() )
				->execute( self::getConnection(), TRUE )
			;
		}
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
				->setExpectations( [ Query::EXPECT_EXACTLY_ONE, ] )
				->execute( self::getConnection() )
		);
	}

	private static /*Connection*/ function getConnection()
	{
		return ConnectionManager::get( static::CONNECTION );
	}
}
<?php

namespace Hector\Core\Orm;

use Hector\Core\Util\Arrayable;
use Hector\Core\Db\ConnectionManager;
use Hector\Core\Db\QueryBuilder\Query;

abstract class Model implements \JsonSerializable
{
	const TABLE = NULL;
	const CONNECTION = NULL;

	protected static /*string*/ $primary_key = 'id';
	protected static /*string*/ $fields = [];

	const TYPE_TEXT = 'Hector\\Core\\Orm\\Type\\Text';
	const TYPE_INT = 'Hector\\Core\\Orm\\Type\\Integer';
	const TYPE_JSON = 'Hector\\Core\\Orm\\Type\\JSON';

	private $rowData = [];

	public function __construct( $data = [] )
	{
		foreach( static::$fields as $field => $definition )
		{
			if( isset( $data[ $field ] ) )
			{
				$this->{ $field } = $data[ $field ];
			}
			else
			{
				$this->createField( $field );
			}
		}
	}

	final public static /*static*/ function create( /*array*/ $data )
	{
		return new static( $data );
	}

	final private function createField( $k )
	{
		if( !isset( $this->rowData[ $k ] ) && isset( static::$fields[ $k ] ) )
		{
			$definition = static::$fields[ $k ];

			if( is_array( $definition ) )
			{
				$this->rowData[ $k ] = new $definition[ 0 ]( $this, NULL, $definition[ 1 ] );
				return;
			}
			else
			{
				$this->rowData[ $k ] = new $definition( $this, NULL );
				return;
			}
		}
	}

	final public function __set( $k, $v )
	{
		$this->createField( $k );
		$this->rowData[ $k ]->setValue( $v );
	}

	final public function __get( $k )
	{
		$this->createField( $k );
		return $this->rowData[ $k ]->getValue();
	}

	final protected function getData()
	{
		$data = [];

		foreach( $this->rowData as $field => $value )
		{
			$data[ $field ] = $value->getRawValue();
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
//		if( isset( $this->rowData[ static::$primary_key ] ) && $this->rowData[ static::$primary_key ]->value !== NULL )
//		{
//			Query::update( static::TABLE )
//				->set( $this->getData() )
//				->where( [ static::$primary_key => $this->rowData[ static::$primary_key ]->getValue() ] )
//				->execute( self::getConnection(), TRUE )
//			;
//		}
//		else
//		{

			Query::insert( static::TABLE )
				->values( $this->getData() )
				->execute( self::getConnection(), TRUE )
			;
//		}
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

	public function jsonSerialize()
	{
		return $this->rowData;
	}
}
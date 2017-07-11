<?php

namespace Hector\Core\Db\Orm;

class ModelStack implements \Countable, \SeekableIterator
{
	private $model;
	private $rows;
	private $count;
	private $index;

	public function __construct($model, $rows = [])
	{
		$this->model = $model;
		$this->rows = $rows;
	}

	public function count()
	{
		if( ! $this->count )
		{
			$this->count = count( $this->rows );
		}

		return $this->count;
	}

	public function rewind()
	{
		return $this->seek( 0 );
	}

	public function seek( $index )
	{
		$this->index = $index;
	}

	public function next()
	{
		$this->index++;

		if( $this->valid() )
		{
			return;
		}

		$this->index = -1;
	}

	public function key()
	{
		return $this->valid() ? $this->index : NULL;
	}

	public function current()
	{
		if( ! $this->valid() )
		{
			return FALSE;
		}

		return new $this->model( $this->rows[ $this->index ] );
	}

	public function valid()
	{
		return $this->index > -1 && $this->index < $this->count();
	}

	// ORM specific methods

	public function delete()
	{
		foreach( $this as $model )
		{
			$model->delete();
		}
	}
}
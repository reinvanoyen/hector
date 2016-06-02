<?php

namespace Hector\Core\Orm\Type;

class Type implements \JsonSerializable
{
	private $model;
	public $value;
	protected $options = [];

	final public function __construct( $model, $value, $options = [] )
	{
		$this->model = $model;
		$this->options = $options;
		$this->setValue( $value );
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setValue( $value )
	{
		// Default option
		if( isset( $this->options[ 'default' ] ) && $value === NULL )
		{
			$value = $this->options[ 'default' ];
		}

		// Sync option
		if( isset( $this->options[ 'sync' ] ) )
		{
			if( is_array( $this->options[ 'sync' ] ) )
			{
				foreach( $this->options[ 'sync' ] as $field )
				{
					$this->model->{ $field } = $value;
				}
			}
			else
			{
				$this->model->{ $this->options[ 'sync' ] } = $value;
			}
		}

		$this->value = $value;
	}

	public function jsonSerialize()
	{
		return $this->getValue();
	}
}
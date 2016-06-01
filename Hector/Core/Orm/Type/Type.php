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
		if( isset( $this->options[ 'sync' ] ) )
		{
			echo 'FIELD:' . $this->model->{ $this->options[ 'sync' ] };

			$this->model->{ $this->options[ 'sync' ] } = $value;
		}

		$this->value = $value;
	}

	public function jsonSerialize()
	{
		return $this->getValue();
	}
}
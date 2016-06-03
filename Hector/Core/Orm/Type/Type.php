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

	public function setValue( $value )
	{
		$this->value = $value;
	}

	public function getRawValue()
	{
		return $this->getValue();
	}

	public function getValue()
	{
		return $this->value;
	}

	public function jsonSerialize()
	{
		return $this->getValue();
	}
}
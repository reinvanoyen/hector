<?php

namespace Hector\Backend;

use Hector\Backend\Action\AbstractAction;

abstract class Module implements \JsonSerializable
{
	public $actions = [];

	abstract public function build();
	
	public function addAction( $id, AbstractAction $action )
	{
		$this->actions[ $id ] = $action;
	}

	public function jsonSerialize()
	{
		return [
			'actions' => $this->actions,
		];
	}
}
<?php

namespace Hector\Core\Env;

use Hector\Env\EnvReaderInterface;

class FileReader implements EnvReaderInterface
{
	private $filename;

	public function __construct(String $filename)
	{
		$this->filename = $filename;
	}

	public function get(String $name, $default) : String
	{
		return $name; // @TODO
	}
}
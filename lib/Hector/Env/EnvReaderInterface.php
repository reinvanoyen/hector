<?php

namespace Hector\Env;

interface EnvReaderInterface
{
	public function get(String $name, $default) : String;
}
<?php

namespace Hector\Config;

interface ConfigLoaderInterface
{
	public function load();
	public function isLoaded() : bool;
	public function getVariables() : array;
	public function set(string $name, $value);
}
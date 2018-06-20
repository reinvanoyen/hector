<?php

namespace Hector\Config;

interface ConfigRepositoryInterface
{
	public function __construct(ConfigLoaderInterface $configLoader);
	public function get(string $name, $default = null);
	public function has(string $name) : bool;
	public function set(string $name, $value);
	public function all() : array;
}
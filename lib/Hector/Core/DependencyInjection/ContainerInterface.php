<?php

namespace Hector\Core\DependencyInjection;

interface ContainerInterface
{
	public function get($id);
	public function has($id);
}
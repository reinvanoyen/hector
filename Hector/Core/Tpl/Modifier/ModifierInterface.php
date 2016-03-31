<?php

namespace Hector\Core\Tpl\Modifier;

interface ModifierInterface
{
	public function parse( &$string );
}
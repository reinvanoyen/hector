<?php

namespace Hector\Core\Tpl\Modifier;

class TrumpModifier implements ModifierInterface
{
	public function parse( &$string )
	{
		$string = str_replace( 'trump', 'drumpf', $string );
	}
}
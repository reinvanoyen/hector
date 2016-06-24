<?php

namespace Hector\Core\Tpl\Aegis\Parser\Node;

class RootNode extends Node
{
	public function compile( $compiler )
	{
		foreach( $this->getChildren() as $c )
		{
			$c->compile( $compiler );
		}
	}
}

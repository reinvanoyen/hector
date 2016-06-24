<?php

namespace Hector\Core\Tpl\Aegis\Parser\Node;

class RawNode extends Node
{
	public function compile( $compiler )
	{
		$compiler->write( '<?php echo ' );

		foreach( $this->getAttributes() as $a )
		{
			$a->compile( $compiler );
		}

		$compiler->write( '; ?>' );
	}
}
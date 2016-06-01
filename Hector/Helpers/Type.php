<?php

namespace Hector\Helpers\Type;

/*boolean*/ function isWeakInt( $value )
{
	return ( $value === '' . (int) $value . '' ) || ( $value === (int) $value );
}
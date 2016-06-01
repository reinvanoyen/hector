<?php

/*boolean*/ function isWeakInt( $value )
{
	return ( $value === '' . (int) $value . '' ) || ( $value === (int) $value );
}

var_dump( isWeakInt( $int ) );
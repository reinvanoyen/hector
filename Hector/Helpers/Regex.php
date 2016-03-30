<?php

namespace Hector\Helpers\Regex;

/*boolean*/ function namedPregMatch( /*string*/ $pattern, /*string*/ $subject, /*array*/ &$matches = [] )
{
	if( preg_match( $pattern, $subject, $matches ) )
	{
		foreach( $matches as $k => $v )
		{
			if( is_int( $k ) )
			{
				unset( $matches[ $k ] );
			}
		}

		return TRUE;
	}

	return FALSE;
}
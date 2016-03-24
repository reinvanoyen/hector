<?php

namespace hector\helpers\regex;

/*boolean*/ function preg_match_named( /*string*/ $pattern, /*string*/ $subject, /*array*/ &$matches = [] )
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
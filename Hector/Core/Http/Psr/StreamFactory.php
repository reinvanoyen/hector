<?php

namespace Hector\Core\Http\Psr;

use Psr\Http\Message\StreamInterface;

class StreamFactory
{
	public static function create( $resource = NULL )
	{
		switch( gettype( $resource ) ) {

			case 'resource':
				return new Stream( $resource );
			case 'NULL':
				return new Stream( fopen('php://temp', 'r+' ) );
		}
	}
}
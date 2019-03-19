<?php

namespace Hector\Http;

use Hector\Http\Stream;

class StreamFactory
{
    public static function create($resource = null)
    {
        switch (gettype($resource)) {

            case 'resource':
                return new Stream($resource);
            case 'NULL':
                return new Stream(fopen('php://temp', 'r+'));
        }
    }
}

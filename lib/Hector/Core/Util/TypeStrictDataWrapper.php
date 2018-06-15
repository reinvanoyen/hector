<?php

namespace Hector\Core\Util;

class TypeStrictDataWrapper
{
    /*array*/ private $data;

    public function __construct(/*array*/ &$data)
    {
        $this->data = &$data;
    }

    /*boolean*/ public function has(/*mixed*/ $key)
    {
        return isset($this->data[ $key ]);
    }

    /*mixed*/ public function raw(/*mixed*/ $key, /*mixed*/ $default = '')
    {
        return isset($this->data[ $key ]) ? $this->data[ $key ] : $default;
    }

    /*string*/ public function string(/*mixed*/ $key, /*mixed*/ $default = '')
    {
        return isset($this->data[ $key ]) ? trim($this->data[ $key ]) : $default;
    }

    /*integer*/ public function integer(/*mixed*/ $key)
    {
        return isset($this->data[ $key ]) ? (int) $this->data[ $key ] : 0;
    }

    /*mixed*/ public function enum(/*mixed*/ $key, /*array*/ $values)
    {
        return isset($this->data[ $key ]) && in_array($this->data[ $key ], $values) ? $this->data[ $key ] : first($values);
    }

    /*mixed*/ public function json(/*mixed*/ $key)
    {
        return isset($this->data[ $key ]) ? json_decode($this->data[ $key ], true) : null;
    }
}

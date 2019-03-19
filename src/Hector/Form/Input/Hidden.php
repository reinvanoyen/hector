<?php

namespace Hector\Form\Input;

class Hidden extends Text
{
    public function __construct(string $name, string $default = '')
    {
        parent::__construct($name, $default);
        $this->type = 'hidden';
    }
}

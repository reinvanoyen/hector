<?php

namespace Hector\Form\Input;

class Hidden extends Text
{
    public function __construct(String $name, String $default = '')
    {
        parent::__construct($name, $default);
        $this->type = 'hidden';
    }
}
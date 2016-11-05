<?php

namespace Hector\Form\Input;

class Password extends Text
{
    public function __construct(String $name, String $default = '')
    {
        parent::__construct($name, $default);
        $this->type = 'password';
    }
}
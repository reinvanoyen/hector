<?php

namespace Hector\Form\Input;

class Password extends Text
{
    public function __construct(string $name, string $default = '')
    {
        parent::__construct($name, $default);
        $this->type = 'password';
    }
}
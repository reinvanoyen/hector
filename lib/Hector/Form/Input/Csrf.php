<?php

namespace Hector\Form\Input;

use Hector\Core\Session;

class Csrf extends Hidden
{
    public function __construct()
    {
        parent::__construct('__csrf', Session::get('csrf'));
    }

    public function validate()
    {
        return ($this->getValue() === Session::get('csrf'));
    }
}

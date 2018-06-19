<?php

namespace Hector\Form\Input;

use Hector\Core\Session;

// @TODO fix this class with a working Dependency Injected session...

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

<?php

namespace Hector\Core\V8n;

abstract class Rule
{
    protected $value;

    public function __construct(Validator $validator, $value)
    {
        $this->validator = $validator;
        $this->value = $value;
    }

    abstract public function validate();
}

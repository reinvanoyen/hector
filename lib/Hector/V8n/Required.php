<?php

namespace Hector\Core\V8n;

class Required extends Rule
{
    public function validate()
    {
        return (boolean) ($this->value);
    }
}

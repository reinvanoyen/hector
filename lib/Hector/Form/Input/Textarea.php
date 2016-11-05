<?php

namespace Hector\Form\Input;

class Textarea extends Input
{
    private $default;

    public function __construct(String $name, String $default = '')
    {
        parent::__construct($name);
        $this->default = $default;
    }

    public function render(Array $opts = [])
    {
        $html = '<textarea name="'.$this->getName().'">';
        if ($this->default) {
            $html .= $this->default;
        }
        $html .= '</textarea>';
        return $html;
    }
}
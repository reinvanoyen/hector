<?php

namespace Hector\Form\Input;

class Textarea extends Input
{
    private $default;

    public function __construct(string $name, string $default = '')
    {
        parent::__construct($name);
        $this->default = $default;
    }

    public function render(array $opts = [])
    {
        $html = '<textarea name="'.$this->getName().'">';
        if ($this->default) {
            $html .= $this->default;
        }
        $html .= '</textarea>';
        return $html;
    }
}
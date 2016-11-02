<?php

namespace Hector\Form\Input;

class Text extends Input
{
    private $default;
    protected $type = 'text';

    public function __construct(String $name, String $default = '')
    {
        parent::__construct($name);
        $this->default = $default;
    }

	public function render()
    {
        $html = '<input type="'.$this->type.'" name="'.$this->getName().'"';
        if ($this->default) {
            $html .= ' value="'.$this->default.'"';
        }
        $html .= ' />';
        return $html;
    }
}
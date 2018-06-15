<?php

namespace Hector\Form\Input;

use Hector\Form\Form;

abstract class Input
{
    private $form;
    private $name;

    public function __construct(String $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    public function validate()
    {
        return true;
    }

    public function getValue()
    {
        return $this->form->request->getParsedBody()[ $this->name ];
    }

    abstract public function render(array $opts);
}

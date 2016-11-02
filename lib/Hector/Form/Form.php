<?php

namespace Hector\Form;

use Aegis\NodeRegistry;
use Hector\Core\Http\Request;
use Hector\Form\Input\Hidden;
use Hector\Form\Input\Input;
use Hector\Form\Input\Csrf;
use Hector\Form\Input\Text;
use Hector\Form\Input\Textarea;

class Form
{
    public $request;
    private $inputs;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->add(new Csrf());

        NodeRegistry::register([
            'Hector\\Form\\Node\\FormNode',
            'Hector\\Form\\Node\\InputNode',
        ]);
    }

    public function addText(String $inputName)
    {
        $this->add(new Text($inputName));
    }

    public function addHidden(String $inputName )
    {
        $this->add(new Hidden($inputName));
    }

    public function addTextarea(String $inputName )
    {
        $this->add(new Textarea($inputName));
    }

    private function add(Input $input)
    {
        $input->setForm( $this );
        $this->inputs[$input->getName()] = $input;
    }

    public function get( String $inputName )
    {
        return $this->inputs[ $inputName ];
    }

    private function isSent()
    {
        return ($this->request->getMethod() === 'POST');
    }

    public function validate()
    {
        if ($this->isSent()) {

            $isValid = true;

            foreach ($this->inputs as $input) {
                $isValid = $input->validate() && $isValid;
            }

            return $isValid;
        }

        return false;
    }
}

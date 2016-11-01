<?php

namespace Hector\Form;

use Hector\Core\Session;
use Hector\Core\Http\Request;
use Hector\Form\Input\Input;
use Hector\Form\Input\Csrf;

class Form
{
    public $request;
    private $inputs;

    public function __construct( Request $request )
    {
        $this->request = $request;

        $this->add( new Csrf() );
    }

    public function add( Input $input )
    {
        $input->setForm( $this );
        $this->inputs[] = $input;
    }

    public function get( String $inputName )
    {
        return $this->inputs[ $inputName ];
    }

    private function isSent()
    {
        if( $this->request->getMethod() === 'POST' ) {
            return true;
        }
        return false;
    }

    public function validate()
    {
        if( $this->isSent() ) {

            $isValid = true;

            foreach( $this->inputs as $input ) {

                $isValid = $input->validate() && $isValid;
            }

            return $isValid;
        }

        return false;
    }
}

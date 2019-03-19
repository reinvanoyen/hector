<?php

namespace Hector\Form;

use Hector\Core\Http\Request;
use Hector\Form\Input\Hidden;
use Hector\Form\Input\Input;
use Hector\Form\Input\Csrf;
use Hector\Form\Input\Text;
use Hector\Form\Input\Password;
use Hector\Form\Input\Textarea;

class Form
{
    /**
     * @var Request
     */
    public $request;

    /**
     * Stores the input instances for this form
     *
     * @var array Input[]
     */
    private $inputs = [];

    /**
     * @var bool
     */
    private $isValidated = false;

    /**
     * Form constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        //$this->add(new Csrf());
    }

    /**
     * Adds a text input to the form
     *
     * @param string $inputName
     */
    public function addText(string $inputName)
    {
        $this->add(new Text($inputName));
    }

    /**
     * Adds a password input to the form
     *
     * @param string $inputName
     */
    public function addPassword(string $inputName)
    {
        $this->add(new Password($inputName));
    }

    /**
     * Adds a hidden input to the form
     *
     * @param string $inputName
     */
    public function addHidden(string $inputName)
    {
        $this->add(new Hidden($inputName));
    }

    /**
     * Adds a textarea input to the form
     *
     * @param string $inputName
     */
    public function addTextarea(string $inputName)
    {
        $this->add(new Textarea($inputName));
    }

    /**
     * Adds an instance of input to the form
     *
     * @param Input $input
     */
    private function add(Input $input)
    {
        $input->setForm($this);
        $this->inputs[$input->getName()] = $input;
    }

    /**
     * Gets an instance of input by its name
     *
     * @param string $inputName
     * @return Input
     */
    public function get(string $inputName) : Input
    {
        return $this->inputs[$inputName];
    }

    /**
     * Check if the form is sent
     *
     * @return bool
     */
    private function isSent() : bool
    {
        // @TODO improve this to allow multiple forms etc, using a unique id for each form AND including CSFR
        return ($this->request->getMethod() === 'POST');
    }

    /**
     * Validate the form
     *
     * @return bool
     */
    public function validate()
    {
        if (! $this->isSent()) {
            return false;
        }

        $isValid = true;

        foreach ($this->inputs as $input) {
            $isValid = $input->validate() && $isValid;
        }

        $this->isValidated = $isValid;

        return $this->isValidated();
    }

    public function isValidated() : bool
    {
        return $this->isValidated;
    }
}

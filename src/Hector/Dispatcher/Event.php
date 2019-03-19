<?php

namespace Hector\Dispatcher;

use Hector\Contracts\Dispatcher\EventInterface;

class Event implements EventInterface
{
    private $propagationStopped = false;

    public function isPropagationStopped(): bool
    {
        return $this->propagationStopped;
    }

    public function stopPropagation()
    {
        $this->propagationStopped = true;
    }
}

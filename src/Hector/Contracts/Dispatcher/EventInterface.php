<?php

namespace Hector\Contracts\Dispatcher;

interface EventInterface
{
    public function isPropagationStopped(): bool;
    public function stopPropagation();
}

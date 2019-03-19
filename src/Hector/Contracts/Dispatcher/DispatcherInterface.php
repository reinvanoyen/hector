<?php

namespace Hector\Contracts\Dispatcher;

interface DispatcherInterface
{
    public function addListener(string $eventName, callable $listener);
    public function getListeners(string $eventName): array;
    public function hasListeners(string $eventName): bool;
    public function dispatch(string $eventName, EventInterface $event = null);
}

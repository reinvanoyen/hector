<?php

namespace Hector\Core\Http\Contract;

use Psr\Http\Message\ServerRequestInterface;

interface KernelInterface
{
    public function handle(ServerRequestInterface $request);
}
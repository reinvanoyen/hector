<?php

namespace Hector\Contracts\Http;

use Psr\Http\Message\ServerRequestInterface;

interface KernelInterface
{
    public function handle(ServerRequestInterface $request);
}
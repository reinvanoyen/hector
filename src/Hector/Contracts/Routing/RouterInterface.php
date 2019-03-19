<?php

namespace Hector\Contracts\Routing;

use \Psr\Http\Message\ServerRequestInterface;

interface RouterInterface
{
    public function route(ServerRequestInterface $request);
}

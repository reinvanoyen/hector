<?php

namespace Hector\Core\Routing\Contract;

use \Psr\Http\Message\ServerRequestInterface;

interface RouterInterface
{
    public function route(ServerRequestInterface $request);
}

<?php

namespace Hector\Core\Http;

use Hector\Core\Container\Container;
use Hector\Core\Http\Contract\KernelInterface;
use Hector\Core\Routing\Contract\RouterInterface;
use Psr\Http\Message\ServerRequestInterface;

class Kernel implements KernelInterface
{
    private $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function handle(ServerRequestInterface $request)
    {
        $router = $this->app->get(RouterInterface::class);
        $response = $router->route($request);

        if (! headers_sent()) {

            // Status
            header(sprintf(
                'HTTP/%s %s %s',
                $response->getProtocolVersion(),
                $response->getStatusCode(),
                $response->getReasonPhrase()
            ));

            // Headers
            foreach ($response->getHeaders() as $name => $values) {
                foreach ($values as $value) {
                    header(sprintf('%s: %s', $name, $value), false);
                }
            }
        }

        echo $response->getBody()->getContents();
    }
}
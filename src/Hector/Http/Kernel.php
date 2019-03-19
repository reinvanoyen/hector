<?php

namespace Hector\Http;

use Hector\Contracts\Container\ContainerInterface;
use Hector\Contracts\Http\KernelInterface;
use Hector\Contracts\Routing\RouterInterface;
use Psr\Http\Message\ServerRequestInterface;

class Kernel implements KernelInterface
{
    /**
     * @var ContainerInterface
     */
    private $app;

    /**
     * Kernel constructor.
     * @param ContainerInterface $app
     */
    public function __construct(ContainerInterface $app)
    {
        $this->app = $app;
    }

    /**
     * Handle the incoming request
     *
     * @param ServerRequestInterface $request
     */
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

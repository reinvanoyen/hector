<?php

namespace Hector\Session\Provider;

use Hector\Contracts\Config\RepositoryInterface;
use Hector\Core\Container\Container;
use Hector\Core\Provider\ServiceProvider;
use Hector\Core\Routing\Facade\Router;
use Hector\Session\FileSessionHandler;
use Hector\Session\Session;
use Hector\Session\Middleware\SessionMiddleware;

class SessionServiceProvider extends ServiceProvider
{
    public function register(Container $app)
    {
        $app->set(\SessionHandlerInterface::class, FileSessionHandler::class);

        $app->singleton(Session::class, function () use ($app) {
            $config = $app->get(RepositoryInterface::class);
            $path = $config->get('SESSION_DIR', 'sessions');
            $sessionName = $config->get('SESSION_NAME', 'session');

            return new Session(
                $app->getWith(\SessionHandlerInterface::class, ['path' => $path,]),
                $sessionName
            );
        });

        $app->singleton(SessionMiddleware::class, SessionMiddleware::class);
    }

    public function boot(Container $app)
    {
        Router::add($app->get(SessionMiddleware::class));
    }
}

<?php

namespace Hector\Db;

use Hector\Config\Contract\ConfigRepositoryInterface;
use Hector\Core\Container\Container;
use Hector\Core\Provider\ServiceProvider;
use Hector\Db\Orm\Manager;
use \Hector\Db\Contract\ConnectionManagerInterface;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(Container $app)
    {
        $app->set('db.factory', function () use ($app) {
            return new ConnectionFactory($app->get(ConfigRepositoryInterface::class));
        });

        $app->set(ConnectionManagerInterface::class, function () use ($app) {
            return new ConnectionManager($app->get('db.factory'));
        });
    }

    public function boot(Container $app)
    {
        Manager::setDb($app->get(ConnectionManagerInterface::class));
    }
}
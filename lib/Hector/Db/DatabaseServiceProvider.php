<?php

namespace Hector\Db;

use Hector\Core\Container\Container;
use Hector\Core\Provider\ServiceProvider;
use Hector\Db\Orm\Model;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(Container $app)
    {
        $app->set('db.factory', function () use ($app) {
            return new ConnectionFactory($app->get('config'));
        });

        $app->set('db', function () use ($app) {
            return new ConnectionManager($app->get('db.factory'));
        });
    }

    public function boot(Container $app)
    {
        Model::setConnectionManager($app->get('db'));
    }
}

<?php

namespace Hector\Db;

use Hector\Core\Application;
use Hector\Core\Provider\ServiceProvider;
use Hector\Db\Orm\Model;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(Application $app)
    {
        $app->set('db.factory', function () use ($app) {
            return new ConnectionFactory($app->get('config'));
        });

        $app->set('db', function () use ($app) {
            return new ConnectionManager($app->get('db.factory'));
        });
    }

    public function boot(Application $app)
    {
        Model::setConnectionManager($app->get('db'));
    }
}

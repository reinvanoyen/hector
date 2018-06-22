<?php

namespace Hector\Form;

use Hector\Core\Application;
use Hector\Core\Provider\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    public function register(Application $app)
    {
        $app->factory('form', function () use ($app) {
            return new Form($app->get('request'));
        });
    }
}

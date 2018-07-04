<?php

namespace Hector\Form;

use Hector\Core\DependencyInjection\Container;
use Hector\Core\Provider\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    public function register(Container $app)
    {
        $app->factory('form', function () use ($app) {
            return new Form($app->get('request'));
        });
    }
}

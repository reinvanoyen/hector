<?php

namespace Hector\Form;

use Hector\Core\Container\Container;
use Hector\Core\Provider\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    public function register(Container $app)
    {
        $app->set('form', function () use ($app) {
            return new Form($app->get('request'));
        });
    }
}

<?php

namespace Hector\Core\Provider;

use Hector\Core\DependencyInjection\Container;

class ConfigServiceProvider extends ServiceProvider
{
    protected $isLazy = true;

    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function register(Container $app)
    {
        $app->set('config', function () {
            return $this->config;
        });
    }

    public function provides(): array
    {
        return ['config',];
    }
}

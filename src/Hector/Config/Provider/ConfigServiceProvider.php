<?php

namespace Hector\Config\Provider;

use Hector\Contracts\Container\ContainerInterface;
use Hector\Core\Provider\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    protected $isLazy = true;

    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function register(ContainerInterface $app)
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

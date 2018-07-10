<?php

namespace Hector\Facade;

use Hector\Core\Container\ContainerInterface;

abstract class Facade
{
    /**
     * The container from which to resolve the instances
     *
     * @var ContainerInterface $container
     */
    private static $container;

    /**
     * The resolved instance of the current facade
     *
     * @var $instance
     */
    protected static $instance;

    /**
     *
     *
     * @param ContainerInterface $container
     */
    public static function setContainer(ContainerInterface $container)
    {
        self::$container = $container;
    }

    abstract protected static function getContract(): string;

    public static function __callStatic($method, $arguments)
    {
        if (! self::$container) {
            throw new \Exception('No container set for facades');
        }

        if (! static::$instance) {
            static::$instance = self::$container->get(static::getContract());
        }

        return static::$instance->$method(...$arguments);
    }
}
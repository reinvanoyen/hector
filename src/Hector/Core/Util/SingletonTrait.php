<?php

namespace Hector\Core\Util;

// @TODO deprecate this trait

trait SingletonTrait
{
    private static $instance;

    private static function getInstance()
    {
        if (! self::$instance) {
            return self::$instance = new static();
        }

        return self::$instance;
    }
}

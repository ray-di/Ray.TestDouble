<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

final class SpyLog
{
    /**
     * @var string
     */
    public $class;

    /**
     * @var string
     */
    public $method;

    /**
     * @var array
     */
    public $arguments;

    /**
     * @var mixed
     */
    public $result;

    /**
     * @var float
     */
    public $time;
}

<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use Ray\TestDouble\Annotation\Fakeable;

/**
 * @Fakeable
 */
class TestClass
{
    public function output()
    {
        return  'test class output';
    }
}

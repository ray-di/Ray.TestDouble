<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

class FakeTarget
{
    public function exec($a, $b)
    {
        return $a + $b;
    }
}

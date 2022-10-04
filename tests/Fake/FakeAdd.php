<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

class FakeAdd implements FakeAddInterface
{
    public function add(int $a, int $b): int
    {
        return $a + $b;
    }
}

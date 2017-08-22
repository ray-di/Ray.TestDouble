<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use Ray\Di\AbstractModule;

class FakeSpyModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(FakeSpy::class);
        $this->install(new TestDoubleModule);
    }
}

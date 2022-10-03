<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use Ray\Di\AbstractModule;

class ClassNameBindingsModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(FakeTarget::class);
        $spyTargets = [
            FakeTarget::class
        ];
        $this->install(new TestDoubleModule($spyTargets));
    }
}

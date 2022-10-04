<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use Ray\Aop\FakeInterceptor;
use Ray\Di\AbstractModule;

class FakeModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(FakeAddInterface::class)->to(FakeAdd::class);
        $spyTargets = [
            FakeAddInterface::class
        ];
        $this->install(new TestDoubleModule($spyTargets));
    }
}

<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use Ray\Di\AbstractModule;
use Ray\TestDouble\Annotation\Fakeable;

class TestDoubleModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bindInterceptor(
            $this->matcher->annotatedWith(Fakeable::class),
            $this->matcher->any(),
            [TestDoubleInterceptor::class]
        );
    }
}

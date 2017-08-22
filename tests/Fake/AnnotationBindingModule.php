<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use Ray\Di\AbstractModule;

class AnnotationBindingModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(TestClass::class);
        $this->install(new TestDoubleModule);
    }
}

<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use PHPUnit\Framework\TestCase;
use Ray\Di\Injector;

class TestDoubleInterceptorTest extends TestCase
{
    public function testAnnotationBinding()
    {
        $fake = (new Injector(new AnnotationBindingModule))->getInstance(TestClass::class);
        $acutual = $fake->output();
        $expected = 'fake class output';
        $this->assertSame($expected, $acutual);
    }

    public function testClassNameBinding()
    {
        $fake = (new Injector(new ClassNameBindingsModule))->getInstance(TestClass::class);
        $acutual = $fake->output();
        $expected = 'fake class output';
        $this->assertSame($expected, $acutual);
    }
}

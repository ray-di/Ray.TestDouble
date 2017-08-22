<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use Ray\Di\Injector;

class TestDoubleInterceptorTest extends \PHPUnit_Framework_TestCase
{
    public function testFakeRequest()
    {
        $fake = (new Injector(new TestModule))->getInstance(TestClass::class);
        $acutual = $fake->output();
        $expected = 'fake class output';
        $this->assertSame($expected, $acutual);
    }
}

<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use PHPUnit\Framework\TestCase;
use Ray\Di\Injector;

class SpyInterceptorTest extends TestCase
{
    public function testSpy()
    {
        $injector = new Injector(new ClassNameBindingsModule, __DIR__ . '/tmp');
        $fake = $injector->getInstance(FakeTarget::class);
        /* @var $fake FakeTarget */
        $spy = $injector->getInstance(Spy::class);
        /* @var $spy Spy */
        $fake->exec(1, 2);
        $logs = $spy->getLogs(FakeTarget::class, 'exec');
        $this->assertCount(1, $logs);
        $log = $logs[0];
        /* @var $log \Ray\TestDouble\SpyLog */
        $this->assertSame(FakeTarget::class, $log->class);
        $this->assertSame('exec', $log->method);
        $this->assertSame([1, 2], $log->arguments);
        $this->assertSame(3, $log->result);
        $this->assertIsFloat($log->time);
    }
}

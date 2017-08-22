<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use Ray\Di\Injector;

class SpyInterceptorTest extends \PHPUnit_Framework_TestCase
{
    public function testSpy()
    {
        $injector = new Injector(new FakeSpyModule, __DIR__ . '/tmp');
        $fake = $injector->getInstance(FakeSpy::class);
        /* @var $fake FakeSpy */
        $spy = $injector->getInstance(Spy::class);
        /* @var $spy Spy */
        $result = $fake->exec(1, 2);
        $logs = $spy->getLogs(FakeSpy::class, 'exec');
        $this->assertSame(1, count($logs));
        $log = $logs[0];
        /* @var $log \Ray\TestDouble\SpyLog */
        $this->assertSame(FakeSpy::class, $log->class);
        $this->assertSame('exec', $log->method);
        $this->assertSame([1, 2], $log->argument);
        $this->assertSame(3, $log->result);
        $this->assertInternalType('float', $log->time);
    }
}

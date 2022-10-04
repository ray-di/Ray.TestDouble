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
    public function testSpyLog()
    {
        $injector = new Injector(new FakeModule, __DIR__ . '/tmp');
        $fake = $injector->getInstance(FakeAddInterface::class);
        /* @var $fake FakeAdd */
        $spyLog = $injector->getInstance(SpyLog::class);
        /* @var $spyLog SpyLog */
        $fake->add(1, 2);
        $logs = $spyLog->getLogs(FakeAdd::class, 'add');
        $this->assertCount(1, $logs);
        $log = $logs[0];
        /* @var $log \Ray\TestDouble\Log */
        $this->assertSame([1, 2], $log->arguments);
        $this->assertSame(1, $log->namedArguments['a']);
        $this->assertIsFloat($log->time);
    }
}

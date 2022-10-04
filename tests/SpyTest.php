<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use PHPUnit\Framework\TestCase;

class SpyTest extends TestCase
{
    public function testNewInstance(): void
    {
        $spyLog = new Logger();
        $spy = (new Spy())->newInstance(FakeAdd::class, 'add', $spyLog);
        $spy->add(1, 2);
        $this->assertLog($spyLog);
    }

    private function assertLog(Logger $spyLog): void
    {
        $logs = $spyLog->getLogs(FakeAdd::class, 'add');
        $this->assertCount(1, $logs);
        $log = $logs[0];
        /** @var Log $log */
        $this->assertSame([1, 2], $log->arguments);
        $this->assertSame(1, $log->namedArguments['a']);
        $this->assertIsFloat($log->time);
    }
}

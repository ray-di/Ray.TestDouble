<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use PHPUnit\Framework\TestCase;
use Ray\Di\AbstractModule;
use Ray\Di\Injector;

class SpyInterceptorTest extends TestCase
{
    public function testSpyInterface(): void
    {
        $injector = new Injector(new class extends AbstractModule
            {
            protected function configure(): void
            {
                $this->bind(FakeAddInterface::class)->to(FakeAdd::class);
                $spyTargets = [
                    FakeAddInterface::class,
                ];
                $this->install(new TestDoubleModule($spyTargets));
            }
        }, __DIR__ . '/tmp');

        $fake = $injector->getInstance(FakeAddInterface::class);
        $this->assertLog($fake, $injector);
    }

    public function testSpyClass(): void
    {
        $injector = new Injector(new class extends AbstractModule
        {
            protected function configure(): void
            {
                $this->bind(FakeAdd::class);
                $spyTargets = [FakeAdd::class];
                $this->install(new TestDoubleModule($spyTargets));
            }
        }, __DIR__ . '/tmp');

        $fake = $injector->getInstance(FakeAdd::class);
        $this->assertLog($fake, $injector);
    }

    private function assertLog(FakeAddInterface $fake, Injector $injector): void
    {
        $spyLog = $injector->getInstance(Logger::class);
        /** @var Logger $spyLog */
        $fake->add(1, 2);
        $logs = $spyLog->getLogs(FakeAdd::class, 'add');
        $this->assertCount(1, $logs);
        $log = $logs[0];
        /** @var Log $log */
        $this->assertSame([1, 2], $log->arguments);
        $this->assertSame(1, $log->namedArguments['a']);
        $this->assertIsFloat($log->time);
    }
}

<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use Ray\Aop\MethodInvocation;
use ReflectionClass;

use function assert;
use function microtime;

final class Logger
{
    /** @var array<string, array<string, array<Log>>> */
    private array $logs = [];

    public function log(MethodInvocation $invocation): mixed
    {
        $t = microtime(true);
        /** @psalm-suppress MixedAssignment */
        $result = $invocation->proceed();
        $time = microtime(true) - $t;
        $parent = (new ReflectionClass($invocation->getThis()))->getParentClass();
        assert($parent instanceof ReflectionClass);
        $class =  $parent->getName();
        $method =  $invocation->getMethod()->getName();
        $this->logs[$class][$method][] = new Log(
            (array) $invocation->getArguments(),
            (array) $invocation->getNamedArguments(),
            $result,
            $time,
        );

        return $result;
    }

    /**
     * @param class-string $class
     *
     * @return array<Log>
     */
    public function getLogs(string $class, string $method): array
    {
        if (! isset($this->logs[$class][$method])) {
            return [];
        }

        return $this->logs[$class][$method];
    }
}

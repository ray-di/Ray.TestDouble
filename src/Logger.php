<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use Ray\Aop\MethodInvocation;
use ReflectionClass;

use function microtime;

final class Logger
{
    public function log(MethodInvocation $invocation)
    {
        $t = microtime(true);
        $result = $invocation->proceed();
        $time = microtime(true) - $t;
        $class =  (new ReflectionClass($invocation->getThis()))->getParentClass()->getName();
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
     * @return Log[]
     */
    public function getLogs(string $class, string $method): array
    {
        if (! isset($this->logs[$class][$method])) {
            return [];
        }

        return $this->logs[$class][$method];
    }
}

<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use Ray\Aop\MethodInvocation;

final class Spy
{
    private $logs = [];

    public function proceed(MethodInvocation $invocation)
    {
        $t = microtime(true);
        $result = $invocation->proceed();
        $time = microtime(true) - $t;
        $class = (new \ReflectionClass($invocation->getThis()))->getParentClass()->getName();
        $method = $invocation->getMethod()->getName();
        $args = $invocation->getArguments()->getArrayCopy();
        $spyLog = new SpyLog;
        list(
            $spyLog->class,
            $spyLog->method,
            $spyLog->argument,
            $spyLog->result,
            $spyLog->time
        ) = [
            $class,
            $method,
            $args,
            $result,
            $time
        ];
        $this->logs[$class][$method][] = $spyLog;

        return $result;
    }

    /**
     * @param string $class
     * @param string $name
     *
     * @return SpyLog[]
     */
    public function getLogs($class, $name)
    {
        if (! isset($this->logs[$class][$name])) {
            return [];
        }

        return $this->logs[$class][$name];
    }
}

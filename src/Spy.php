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
    /**
     * @var array
     */
    private $logs = [];

    public function proceed(MethodInvocation $invocation)
    {
        $t = microtime(true);
        $result = $invocation->proceed();
        $time = microtime(true) - $t;
        $spyLog = new SpyLog;
        list(
            $spyLog->class,
            $spyLog->method,
            $spyLog->arguments,
            $spyLog->result,
            $spyLog->time
        ) = [
            (new \ReflectionClass($invocation->getThis()))->getParentClass()->getName(),
            $invocation->getMethod()->getName(),
            $invocation->getArguments()->getArrayCopy(),
            $result,
            $time
        ];
        $this->logs[$spyLog->class][$spyLog->method][] = $spyLog;

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

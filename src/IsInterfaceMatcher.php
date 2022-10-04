<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use Ray\Aop\AbstractMatcher;
use ReflectionClass;
use ReflectionMethod;

use function in_array;

class IsInterfaceMatcher extends AbstractMatcher
{
    /**
     * {@inheritdoc}
     */
    public function matchesClass(ReflectionClass $class, array $arguments): bool
    {
        [$interface] = $arguments;
        $interfaces = $class->getInterfaceNames();

        return in_array($interface, $interfaces);
    }

    /**
     * {@inheritdoc}
     */
    public function matchesMethod(ReflectionMethod $method, array $arguments): bool
    {
        return true;
    }
}

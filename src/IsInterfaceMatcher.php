<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use Override;
use Ray\Aop\AbstractMatcher;
use ReflectionClass;
use ReflectionMethod;

use function in_array;

/** @psalm-api */
class IsInterfaceMatcher extends AbstractMatcher
{
    #[Override]
    public function matchesClass(ReflectionClass $class, array $arguments): bool
    {
        [$interface] = $arguments;
        $interfaces = $class->getInterfaceNames();

        return in_array($interface, $interfaces);
    }

    /** @codeCoverageIgnore */
    #[Override]
    public function matchesMethod(ReflectionMethod $method, array $arguments): bool
    {
        return true;
    }
}

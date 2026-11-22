<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;

/** @psalm-api */
class SpyInterceptor implements MethodInterceptor
{
    public function __construct(
        private LoggerInterface $spyLog,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function invoke(MethodInvocation $invocation)
    {
        return $this->spyLog->log($invocation);
    }
}

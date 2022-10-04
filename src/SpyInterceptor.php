<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;

class SpyInterceptor implements MethodInterceptor
{
    public function __construct(
        private Logger $spyLog,
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function invoke(MethodInvocation $invocation)
    {
        return $this->spyLog->log($invocation);
    }
}

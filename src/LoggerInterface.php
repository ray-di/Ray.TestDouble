<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use Ray\Aop\MethodInvocation;

interface LoggerInterface
{
    public function log(MethodInvocation $invocation): mixed;
}

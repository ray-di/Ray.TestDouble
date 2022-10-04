<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;

class SpyInterceptor implements MethodInterceptor
{
    public function __construct(
        private SpyLog $spyLog
    ){}

    /**
     * {@inheritdoc}
     */
    public function invoke(MethodInvocation $invocation)
    {
        return $this->spyLog->log($invocation);
    }
}

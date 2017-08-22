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
    /**
     * @var Spy
     */
    private $spy;

    public function __construct(Spy $spy)
    {
        $this->spy = $spy;
    }

    /**
     * {@inheritdoc}
     */
    public function invoke(MethodInvocation $invocation)
    {
        return $this->spy->proceed($invocation);
    }
}

<?php

use Ray\TestDouble\Annotation\Spy;
/**
 * @Spy
 */
class Ray_TestDouble_FakeSpy_GTU4lQA extends Ray\TestDouble\FakeSpy implements Ray\Aop\WeavedInterface
{
    private $isIntercepting = true;
    public $bind;
    public $methodAnnotations = 'a:0:{}';
    public $classAnnotations = 'a:1:{i:0;O:29:"Ray\\TestDouble\\Annotation\\Spy":0:{}}';
    function exec($a, $b)
    {
        if ($this->isIntercepting === false) {
            $this->isIntercepting = true;
            return parent::exec($a, $b);
        }
        $this->isIntercepting = false;
        // invoke interceptor
        $result = (new \Ray\Aop\ReflectiveMethodInvocation($this, __FUNCTION__, [$a, $b], $this->bindings[__FUNCTION__]))->proceed();
        $this->isIntercepting = true;
        return $result;
    }
}

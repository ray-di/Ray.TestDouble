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
    public $classAnnotations = 'a:1:{s:29:"Ray\\TestDouble\\Annotation\\Spy";O:29:"Ray\\TestDouble\\Annotation\\Spy":0:{}}';
    function exec($a, $b)
    {
        if (isset($this->bindings[__FUNCTION__]) === false) {
            return call_user_func_array('parent::' . __FUNCTION__, func_get_args());
        }
        if ($this->isIntercepting === false) {
            $this->isIntercepting = true;
            return call_user_func_array('parent::' . __FUNCTION__, func_get_args());
        }
        $this->isIntercepting = false;
        $invocationResult = (new \Ray\Aop\ReflectiveMethodInvocation($this, new \ReflectionMethod($this, __FUNCTION__), new \Ray\Aop\Arguments(func_get_args()), $this->bindings[__FUNCTION__]))->proceed();
        $this->isIntercepting = true;
        return $invocationResult;
    }
}

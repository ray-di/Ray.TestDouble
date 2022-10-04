<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class TestDoubleModule extends AbstractModule
{
    /**
     * @var array<class-string>
     */
    private $spyTargets;

    public function __construct(array $spyTargets = [], AbstractModule $module = null)
    {
        $this->spyTargets = $spyTargets;
        parent::__construct($module);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind(SpyLog::class)->in(Scope::SINGLETON);
        foreach ($this->spyTargets as $interface) {
            $this->bind($interface)->toNull();
            $this->bindInterceptor(
                new IsInterfaceMatcher($interface),
                $this->matcher->any(),
                [SpyInterceptor::class]
            );
        }
    }
}

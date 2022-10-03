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
     * @var array
     */
    private $spyTargets;

    public function __construct(array $spies = [], AbstractModule $module = null)
    {
        $this->spyTargets = $spies;
        parent::__construct($module);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind(Spy::class)->in(Scope::SINGLETON);
        foreach ($this->spyTargets as $spy) {
            $this->bindInterceptor(
                $this->matcher->subclassesOf($spy),
                $this->matcher->any(),
                [SpyInterceptor::class]
            );
        }
    }
}

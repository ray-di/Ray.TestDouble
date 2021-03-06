<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use Ray\Di\AbstractModule;
use Ray\Di\Scope;
use Ray\TestDouble\Annotation\Fakeable;

class TestDoubleModule extends AbstractModule
{
    /**
     * @var array
     */
    private $fakeables;

    /**
     * @var array
     */
    private $spies;

    public function __construct(array $fakeables = [], array $spies = [], AbstractModule $module = null)
    {
        $this->fakeables = $fakeables;
        $this->spies = $spies;
        parent::__construct($module);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind(Spy::class)->in(Scope::SINGLETON);
        $this->bindInterceptor(
            $this->matcher->annotatedWith(\Ray\TestDouble\Annotation\Spy::class),
            $this->matcher->any(),
            [SpyInterceptor::class]
        );
        $this->bindInterceptor(
            $this->matcher->any(),
            $this->matcher->annotatedWith(\Ray\TestDouble\Annotation\Spy::class),
            [SpyInterceptor::class]
        );
        foreach ($this->spies as $spy) {
            $this->bindInterceptor(
                $this->matcher->subclassesOf($spy),
                $this->matcher->any(),
                [SpyInterceptor::class]
            );
        }
        $this->bindInterceptor(
            $this->matcher->annotatedWith(Fakeable::class),
            $this->matcher->any(),
            [TestDoubleInterceptor::class]
        );
        foreach ($this->fakeables as $fakeable) {
            $this->bindInterceptor(
                $this->matcher->subclassesOf($fakeable),
                $this->matcher->any(),
                [TestDoubleInterceptor::class]
            );
        }
    }
}

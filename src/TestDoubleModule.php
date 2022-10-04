<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use Ray\Di\AbstractModule;
use Ray\Di\Scope;
use Ray\TestDouble\Exception\InvalidSpyTargetException;

use function assert;
use function class_exists;
use function interface_exists;
use function is_string;

class TestDoubleModule extends AbstractModule
{
    /** @var array<class-string> */
    private $spyTargets;

    /** @param array<class-string|interface-string> $spyTargets */
    public function __construct(array $spyTargets = [], AbstractModule|null $module = null)
    {
        $this->spyTargets = $spyTargets;
        parent::__construct($module);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind(Logger::class)->in(Scope::SINGLETON);
        foreach ($this->spyTargets as $class) {
            if (interface_exists($class)) {
                $this->bindInterceptor(
                    new IsInterfaceMatcher($class),
                    $this->matcher->any(),
                    [SpyInterceptor::class],
                );
                continue;
            }

            if (class_exists($class)) {
                $this->bindInterceptor(
                    $this->matcher->subclassesOf($class),
                    $this->matcher->any(),
                    [SpyInterceptor::class],
                );
                continue;
            }

            assert(is_string($class));

            throw new InvalidSpyTargetException($class);
        }
    }
}

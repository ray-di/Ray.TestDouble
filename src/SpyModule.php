<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use Ray\Di\AbstractModule;
use Ray\TestDouble\Exception\InvalidSpyTargetException;

use function class_exists;
use function interface_exists;

/** @psalm-api */
class SpyModule extends AbstractModule
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
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->install(new SpyBaseModule());
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

            throw new InvalidSpyTargetException($class);
        }
    }
}

<?php
/**
 * This file is part of the Ray.TestDouble package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\TestDouble;

use Ray\Di\AbstractModule;
use Ray\TestDouble\Annotation\Fakeable;

class TestDoubleModule extends AbstractModule
{
    /**
     * @var array
     */
    private $fakeables;

    public function __construct(array $fakeables = [], AbstractModule $module = null)
    {
        $this->fakeables = $fakeables;
        parent::__construct($module);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
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

<?php

namespace Ray\TestDouble;

use Ray\Di\AbstractModule;

class FakeModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(FakeAddInterface::class)->to(FakeAdd::class);
        $spyTargets = [
            FakeAddInterface::class
        ];
        $this->install(new SpyModule($spyTargets));
    }
}
